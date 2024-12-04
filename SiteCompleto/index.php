<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">


</head>
<script>
    //criando funcionalidade do botão para redirecionar para as outras abas
    function home() {
        window.location.href = "site.php";
    }

    function perfil() {
        location.href = 'perfil.php';
    }

    function atendimento() {
        location.href = 'atendimento.php';
    }
</script>

<body>
    <!--Falta o javaScrip-->
    <header>
        <nav>
            <button type="submit" name="home" value="home" onclick="home()">Home</button>
            <button type="submit" name="" value="Atendimentos" onclick="atendimento()">Atendimentos</button>
            <button type="submit" name="" value="sobre">Sobre</button>
            <button type="submit" name="perfil" value="perfil">Perfil</button>
        </nav>
    </header>



    <center>
        <h1>Bem-Vindo</h1><br>
        <main>
            <div id="container">
                <!--action = "loginphp.php" para o php conferir no DB se á o login-->

                <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars('loginphp.php'); ?>">
                    <label for="pemail">Email:
                        <input type="email" name="email" id="pemail" placeholder="Email" required>
                    </label><br>

                    <label for="psenha">Senha:
                        <input type="password" placeholder="Senha" name="senha" id="psenha" minlength="8" maxlength="50"
                            required>
                    </label><br>

                    <label for="Esqueci a senha!" id="Atualizar_senha">Esqueci a senha!</label>
                    <a href="atuSenha.php">clique aqui!</a>
                    <br>

                    <input type="submit" name="submit" id="penviar" value="Entrar"><br>

                    <?php
                    session_start();
                    if (isset($_SESSION['msg'])) {
                        echo "<p style='color: red;'>" . $_SESSION['msg'] . "</p>";
                        unset($_SESSION['msg']); // Remove a mensagem após exibi-la
                    }
                    ?>
                    <!--Deixar menor e botar para um canto-->
                    <label for="pcadastro" id="pcadastro">Não tem cadastro?</label>
                    <a href="cadastro.php">Cadastrar-se!</a>
                    <br>
                </form>

            </div>
        </main>
    </center>

</body>

</html>