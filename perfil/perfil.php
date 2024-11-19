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

        function escuro() {
            const tema = document.getElementsByTagName('escuro')[0];
            tema.style
            //dps arrumar isso para implementar o modo escuro

        }

        function deletar() {
            const Delete = document.getElementsByName('delete');
            Delete = confirm('você tem certeza?');
        }
    </script>
</head>

<body>

    <header>
        <nav>
            <button type="submit" name="home" value="home" aria-label="Página inicial" onclick="home()">Home</button>
            <button type="submit" name="" value="atendimento" aria-label="">Atendimento</button>
            <button type="submit" name="" value="sobre" aria-label="">Sobre</button>
            <button type="submit" name="" value="perfil" aria-label="Perfil" onclick="perfil()">Perfil</button>
        </nav>
    </header>
    <article>

        <div id="container">
            <label for="Modo escuro">Modo Escuro:
                Sim<input type="checkbox" name="escuto" onclick="escuro()">
                Não<input type="checkbox">

                <form action="<?php echo htmlspecialchars('perfilphp.php'); ?>" method="post">
            </label><br>
            <label for="Deletar a conta">Delete sua conta:<br>

                <input type="email" placeholder="Confirme o seu Email" name="email" id="pemail" required maxlength="100"><br>

                <input type="password" placeholder="Confirme a Sua senha" name="senha" id="psenha"><br>
                
                <?php
                session_start();
                if (isset($_SESSION['msg'])) {
                    echo "<p style='color: red;'>" . $_SESSION['msg'] . "</p>";
                    unset($_SESSION['msg']);
                }
                ?>

                <input type="submit" name="delete" id="delete" value="Deletar"><br>

                </form>
            </label>
        </div>
    </article>



</body>

</html>