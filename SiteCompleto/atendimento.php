<?php
include_once "cadastrophp.php";
include_once "atendimentophp.php";
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
        function atendimento(){
            location.href = 'atendimento.php';
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <button type="submit" name="home" value="home" onclick="home()">Home</button>
            <button type="submit" name="" value="Atendimentos" onclick="atendimento()">Atendimentos</button>
            <button type="submit" name="" value="sobre">Sobre</button>
            <button type="submit" name="perfil" value="perfil">Perfil</button>
        </nav>
    </header>
    <center>

        <h1>Atendimentos Acontecidos</h1>
        <h3 id="h3"><?php echo htmlspecialchars($paciente); ?>
        </h3>
        <table id="tabela">
            <tr>
                <td>
                    <?php
                    $atendimeto->historico();
                    ?>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>