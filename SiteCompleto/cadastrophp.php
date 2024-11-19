<?php
// add data de nascimento e telefone

session_start();
$msg = "";
//Iniciando a conexao o com o banco de dados
if (isset($_POST['enviar'])) {
    include '../configdb.php';
    // incluindo a pdo do pg admin

    try {
        // Adicionando variáveis para cada name dos forms
        $paciente = $_POST['paciente'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sexo = $_POST['sexo'];
        $cripto = password_hash($senha, PASSWORD_DEFAULT);
        $nascimento = $_POST['nascimento'];
        $telefone = $_POST['telefone'];

        // Verificando se o e-mail já existe
        $checandoEmailquery = "SELECT id FROM paciente WHERE email = :email";

        $checandoStmt = $conn->prepare($checandoEmailquery);
        $checandoStmt->bindParam(':email', $email);
        $checandoStmt->execute();

        if ($checandoStmt->rowCount() > 0) {
            // E-mail já existe, redireciona de volta para a página de cadastro
            $_SESSION['msg'] = "Email já cadastrado";
            header("Location: cadastro.php");
            exit();
        }


        // Consulta SQL para inserir os dados
        $query = "INSERT INTO paciente (paciente, email, senha,data_nascimento,telefone ,id_sexo) VALUES (:paciente, :email,:senha,:data_nascimento,:telefone,:sexo)";
        $stmt = $conn->prepare($query);

        // Bind dos parâmetros
        $stmt->bindParam(':paciente', $paciente);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $cripto);
        $stmt->bindParam(':data_nascimento',$nascimento);
        $stmt->bindParam(':telefone',$telefone);
        $stmt->bindParam(':sexo', $sexo);

        // Executa a consulta
        if ($stmt->execute()) {
            // Cadastro realizado com sucesso, redireciona para login.php
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
