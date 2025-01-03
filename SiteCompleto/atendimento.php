<?php
session_start();
require_once "atendimentophp.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="atendimento.css">
    <title>Meus atendimentos</title>
    <script>
        function home() {
            window.location.href = 'index.php';
        }

        function perfil() {
            location.href = 'perfil.php';
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
    <center>

        <h1>Atendimentos Realizados</h1>
        <br>
        <?php
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $atendimeto = new Atendimento($conn, $id, );
            
            $atendimeto->historico();
            echo"<br><p font:>Total de Atendimentos: ";
            $atendimeto->totalDeAtendimentos();
            echo "</p>";
            
            
        } else {
            $id = "Cadastro nescessario";
            echo $id;
        }

        ?>


    </center>
</body>

</html>