<?php
session_start();
$msg = '';


try {
    if (isset($_POST['submit'])) {
        include "../../configdb.php";

        // Captura as variáveis do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];


        $sql = "SELECT * FROM paciente WHERE email = :email";

        $procurando = $conn->prepare($sql);
        $procurando->bindParam(':email', $email);

        if ($procurando->execute() and $procurando->rowCount() > 0) {


            $usuario = $procurando->fetch(PDO::FETCH_ASSOC);
            $id = $procurando->fetch(PDO::FETCH_ASSOC);


            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['paciente'] = $usuario['paciente'];
                $_SESSION['id'] = $usuario['id'];
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
    }
} catch (PDOException $e) {
    $_SESSION['msg'] = "Erro de conexão: " . $e->getMessage();
    header("Location: index.php");
    exit();
}
session_write_close();
