<?php
session_start();
$msg = '';


try {
    if (isset($_POST['submit'])) {
        include '../configdb.php';
        
        // Captura as variáveis do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Consulta para buscar o usuário pelo email
        $sql = "SELECT * FROM paciente WHERE email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute() and $stmt->rowCount() > 0) {
            // Obtém os dados do usuário
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verifica a senha usando password_verify
            if (password_verify($senha, $user['senha'])) {
                $_SESSION['paciente'] = $user['paciente']; // Define a sessão com o nome do usuário
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
