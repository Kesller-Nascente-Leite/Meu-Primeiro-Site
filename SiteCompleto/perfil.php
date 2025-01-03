<?php

require_once 'perfilphp.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="perfil.css">
    <script>
        //criando funcionalidade do botão para redirecionar para as outras abas
        function home() {
            location.href = "site.php";
        }

        function perfil() {
            location.href = "perfil.php";
        }


        document.addEventListener('DOMContentLoaded', function () {
            const buttonCliqueAqui = document.getElementById('Clique_aqui');
            const formulario = document.getElementById('formulario');

            buttonCliqueAqui.addEventListener('click', function () {
                formulario.style.display = 'block';
                buttonCliqueAqui.remove();
            });
        });
    </script>
</head>

<body>

    <header>
        <nav>
            <button type="submit" name="home" value="home" aria-label="Página inicial" onclick="home()">Home</button>
            <button type="submit" name="" value="atendimento" aria-label="">Atendimentos</button>
            <button type="submit" name="" value="sobre" aria-label="">Sobre</button>
            <button type="submit" name="" value="perfil" aria-label="Perfil" onclick="perfil()">Perfil</button>
        </nav>
    </header>

    <article>

        <div id="container">
            <h1>Informações Do Paciente</h1>
            <?php
            session_start();


            if (isset($_SESSION['id'])) {
                echo "<h1>Bem-vindo {$_SESSION['paciente']}!</h1>";
                echo "<p>Email: {$_SESSION['email']}</p>";
                echo "<p>Telefone: {$_SESSION['telefone']}</p>";
                echo "<p>Data de Nascimento: {$_SESSION['data_nascimento']}</p>";
                $sexo = $_SESSION['sexo'] == 1 ? 'Masculino' : 'Feminino';
                echo "<p>Sexo: $sexo</p>";
            } else {
                echo "Usuário não autenticado.";
                header("Location: index.php");
                exit();
            }
            ?>


            <label for="Deletar a conta">

            <input type="button" id="Clique_aqui" value="Clique aqui"><br>

            <form id="formulario" action="<?php echo htmlspecialchars('perfilphp.php'); ?>" method="post">
                </label><br>

                <input type="password" placeholder="Confirme a Sua senha" name="senha" id="psenha" required><br>

                <input type="submit" name="delete" id="delete" value="Confirmar">

            </form>
            <?php
            session_start();
            if (isset($_SESSION['msg'])) {
                echo "<p id='erro'>" . $_SESSION['msg'] . "</p>";
                unset($_SESSION['msg']);
            }
            ?>
        </div>
    </article>



</body>

</html>