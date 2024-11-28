<?php
session_start();
include "../../configdb.php";
$msg = "";
// Por enquanto em sessão 

if (isset($_POST['delete'])) {
    try {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "SELECT senha,id FROM paciente WHERE email = :email";
        $verSeExisteEmail = $conn->prepare($sql);
        $verSeExisteEmail->bindParam(":email", $email);
        $verSeExisteEmail->execute();

        if ($verSeExisteEmail->rowCount() > 0) {
            $paciente = $verSeExisteEmail->fetch(PDO::FETCH_ASSOC);
            $id = $paciente['id'];
            $senhaDoPaciente = $paciente["senha"];

            if (password_verify($senha, $senhaDoPaciente)) {
                $query = "DELETE FROM paciente WHERE id = :id";
                $deletando = $conn->prepare($query);
                $deletando->bindParam(":id", $id);
                $deletando->execute();

                if ($deletando->rowCount() > 0) {
                    $_SESSION["msg"] = "Conta excluida";
                    header("location:index.php");
                    exit();
                } else {
                    $_SESSION["msg"] = "Conta não existe";
                    header("location:perfil.php");
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
