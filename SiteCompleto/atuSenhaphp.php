<?php

session_start();
$msg = '';
if (isset($_POST['enviar'])) {
    include '../configdb.php';

    try {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $checandoEmailquery = "SELECT id, senha FROM paciente where email = :email";
        $checarEmail = $conn->prepare($checandoEmailquery);
        $checarEmail->bindParam(':email', $email);
        $checarEmail->execute();

        if ($checarEmail->rowCount() > 0) {
            // Pega o id do paciente que corresponde ao email
            $paciente = $checarEmail->fetch(PDO::FETCH_ASSOC);
            $id = $paciente['id'];
            $senhaAtual = $paciente['senha'];

            // Verifica se a nova senha é igual à senha atual
            if (password_verify($senha, $senhaAtual)) {
                $_SESSION['msg'] = "A nova senha deve ser diferente da senha atual.";
                session_write_close();
                header("Location: atuSenha.php");
                exit();
            }
            $SenhaCripto = password_hash($senha, PASSWORD_DEFAULT);
            $query = "UPDATE paciente SET senha = :senha WHERE id = :id ";
            $prepararParaExeQuery  = $conn->prepare($query);
            $prepararParaExeQuery->bindParam(':senha', $SenhaCripto);
            $prepararParaExeQuery->bindParam(':id', $id);
            $prepararParaExeQuery->execute();

            if ($prepararParaExeQuery->rowCount() > 0) {
                $_SESSION['msg'] = "Senha Atualizada";
                header("location: index.php");
                exit();
            } else {
                $_SESSION['msg'] = "Mude para uma senha diferente";
                exit();
            }
        } else {
            $_SESSION['msg'] = "Email não encontrado";
            header("Location: atuSenha.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['msg'] = 'Erro ao buscar o email: ' . $e->getMessage();
    }
}
