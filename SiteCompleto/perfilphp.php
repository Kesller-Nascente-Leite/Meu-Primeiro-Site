<?php
session_start();
require_once "../../configdb.php";
require "verifica_sessao.php";
require_once "loginphp.php";


class Perfilphp
{
    private $conn;
    private $id;
    private $email;
    private $senha;
    public function __construct($conn, $id, $email, $senha)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
    }


    public function Deletando()
    {
        try {

            $sql = "SELECT senha,id FROM paciente WHERE email = :email";
            $verSeExisteEmail = $this->conn->prepare($sql);
            $verSeExisteEmail->bindParam(":email", $this->email);
            $verSeExisteEmail->execute();

            if ($verSeExisteEmail->rowCount() > 0) {
                $paciente = $verSeExisteEmail->fetch(PDO::FETCH_ASSOC);
                $id = $paciente['id'];
                $senhaDoPaciente = $paciente["senha"];

                if (password_verify($this->senha, $senhaDoPaciente)) {
                    $query = "DELETE FROM paciente WHERE id = :id";
                    $deletando = $this->conn->prepare($query);
                    $deletando->bindParam(":id", $id);
                    $deletando->execute();

                    if ($deletando->rowCount() > 0) {
                        $_SESSION["msg"] = "Conta excluida";
                        header("location:index.php");
                        exit();
                    }
                } else {
                    $_SESSION["msg"] = "Senha invalida";
                    header("location:perfil.php");
                    exit();
                }
            } else {
                $_SESSION["msg"] = "Email invalido";
                header("location:perfil.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Erro: ", $e->getMessage();
        }
    }
}




$perfil = new Perfilphp($conn, $id, $_POST["email"], $_POST["senha"]);
if (isset($_POST['delete'])) {
    $perfil->Deletando();
}

if (isset($_SESSION['paciente']) and isset($_SESSION['id'])) {
    $paciente = $_SESSION['paciente'];

} else {
    $_SESSION['msg'] = 'login Necessario';
}
