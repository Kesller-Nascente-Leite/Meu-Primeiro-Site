<?php
session_start();
require 'verifica_sessao.php';
require_once "../../configdb.php";

class Usuario
{
    private $conn;
    private $email;
    private $senha;

    public function __construct($conn, $email, $senha)
    {
        $this->conn = $conn;
        $this->email = $email;
        $this->senha = $senha;

    }
    public function verificandoLogin()
    {
        if (empty($this->email) || empty($this->senha)) {
            $_SESSION['msg'] = "Por favor, preencha todos os campos.";
            header("Location: index.php");
            exit();

        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = "Informações invalidas";
            header("Location: index.php");
            exit();
        }
    }

    public function login()
    {

        try {

            $query = "SELECT * FROM paciente WHERE email = :email";

            $procurando = $this->conn->prepare($query);
            $procurando->bindParam(':email', $this->email);

            if ($procurando->execute() and $procurando->rowCount() > 0) {

                $usuario = $procurando->fetch(PDO::FETCH_ASSOC);

                if (password_verify($this->senha, $usuario['senha'])) {
                    
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['email'] = $usuario['email'];
                    $_SESSION['paciente'] = $usuario['paciente'];
                    $_SESSION['telefone'] = $usuario['telefone'];
                    $_SESSION['data_nascimento'] = $usuario['data_nascimento'];
                    $_SESSION['sexo'] = $usuario['id_sexo'];
                    header("Location: site.php");
                    exit();

                } else {
                    $_SESSION['msg'] = "Senha inválida";
                    header("Location: index.php");
                    exit();
                }
            } else {
                $_SESSION['msg'] = "Email inválido";
                header("Location: index.php");
                exit();
            }

        } catch (PDOException $e) {
            $_SESSION['msg'] = "Erro de conexão: " . $e->getMessage();
            header("Location: index.php");
            exit();
        }
    }
}


$login = new Usuario($conn, $_POST["email"], $_POST["senha"]);
if (isset($_POST['submit'])) {
    $login->verificandoLogin();
    $login->login();
}
