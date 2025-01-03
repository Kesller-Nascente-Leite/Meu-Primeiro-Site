<?php
session_start();
require_once "sitephp.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site</title>
<link rel="stylesheet" href="siteCSS.css">
    <script>
        //criando funcionalidade do botão para redirecionar para as outras abas
        function home() {
            location.href = "site.php";
            //document.getElementsByName('home') = location.href = 'index.php';
        }

        function perfil() {
            location.href = "perfil.php";
        }

        function atendimento() {
            location.href = 'atendimento.php';
        }
    </script>
</head>

<body>
<header>
    <nav>
        <button type="button" name="home" onclick="home()">Home</button>
        <button type="button" onclick="atendimento()">Atendimentos</button>
        <button type="button" onclick="sobre()">Sobre</button>
        <button type="button" onclick="perfil()">Perfil</button>
    </nav>
</header>


    <h1>Bem vindo <?php echo HTMLSPECIALCHARS($paciente); ?></h1>
    <a href="index.php">clique para fazer o login</a>

</body>

</html>