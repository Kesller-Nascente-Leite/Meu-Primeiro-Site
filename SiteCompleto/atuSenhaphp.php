<?php
session_start();
require_once "../../configdb.php";


class AtualizarSenha
{
    private $conn;
    private $email;
    private $senha;
    private $paciente;

    public function __construct($conn, $email, $senha)
    {
        $this->conn = $conn;
        $this->email = $email;
        $this->senha = $senha;

    }

    public function checandoEmail()
    {
        try {

            $checandoEmailquery = "SELECT id, senha FROM paciente where email = :email";

            $checarEmail = $this->conn->prepare($checandoEmailquery);

            $checarEmail->bindParam(':email', $this->email);

            $checarEmail->execute();

            if ($checarEmail->rowCount() > 0) {
                $this->paciente = $checarEmail->fetch(PDO::FETCH_ASSOC);
                return true;

            } else {
                $_SESSION['msg'] = "Email não encontrado";
                header("Location: atuSenha.php");
                exit();

            }
        } catch (PDOException $e) {
            $_SESSION['msg'] = 'Erro ao buscar o email: ' . $e->getMessage();
            header("Location: atuSenha.php");
            exit();
        }
    }

    public function verificandoSenhaAtual()
    {

        $senhaAtual = $this->paciente['senha'];

        if (password_verify($this->senha, $senhaAtual)) {
            $_SESSION['msg'] = "A nova senha deve ser diferente da senha atual.";
            header("Location: atuSenha.php");
            exit;
        }
    }
    public function Atualizando()
    {
        try {
            $SenhaCripto = password_hash($this->senha, PASSWORD_DEFAULT);
            $id = $this->paciente['id'];

            $query = "UPDATE paciente SET senha = :senha WHERE id = :id ";

            $prepararParaExeQuery = $this->conn->prepare($query);
            $prepararParaExeQuery->bindParam(':senha', $SenhaCripto);
            $prepararParaExeQuery->bindParam(':id', $id);
            $prepararParaExeQuery->execute();

            if ($prepararParaExeQuery->rowCount() > 0) {
                $_SESSION['msg'] = "Senha Atualizada";
                header("location: index.php");
                exit();
            } else {
                $_SESSION['msg'] = "Nenhuma alteração foi feita.";
                header("Location: atuSenha.php");
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['msg'] = 'Erro ao atualizar a senha: ' . $e->getMessage();
            header("Location: atuSenha.php");
            exit();
        }
    }
}

if (isset($_POST['enviar'])) {
    try {
        $atualizandoSenha = new AtualizarSenha($conn, $_POST['email'], $_POST['senha']);


        if ($atualizandoSenha->checandoEmail()) {
            $atualizandoSenha->verificandoSenhaAtual();
            $atualizandoSenha->Atualizando();
        }
    } catch (PDOException $e) {
        $_SESSION['msg'] = 'Erro ao buscar o email: ' . $e->getMessage();
        exit;
    }
}