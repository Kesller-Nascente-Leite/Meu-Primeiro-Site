<?php
session_start();
include "../../configdb.php";
include 'verifica_sessao.php';
// Por enquanto em sessão 
if (isset($_SESSION['paciente'])) {
    $paciente = $_SESSION['paciente'];
} else {
    $paciente = $_SESSION['paciente'] = "Usuario não logado";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site</title>

    <style>
        body {
            display: inline;
            background-image: url(Post\ Instagram\ Médico\ Clínico\ Moderno\ Simples\ Azul\ Branco.png);
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;

        }


        header {
            background-color: transparent 50%;
            display: flex;
            justify-content: space-around;
            align-items: baseline;
            position: relative;
            top: -20px;
        }

        header>nav>button {
            height: 50px;
            width: 250px;
            color: rgb(0, 0, 0);
            background-color: transparent;
            font-size: 20px;
            border: none;
            cursor: pointer;
            transition-duration: 0.4s;
            border-radius: 5px;
        }

        button:hover {
            background-color: rgb(47, 47, 161);
        }

        a {
            color: red;
        }
    </style>

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
    <!--Beta, dps virará index-->

    <h1>Bem vindo <?php echo HTMLSPECIALCHARS($paciente); ?></h1>
    <a href="index.php">clique para fazer o login</a>

</body>

</html>