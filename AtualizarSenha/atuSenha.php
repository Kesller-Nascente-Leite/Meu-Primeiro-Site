<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="atuSenha.css">
</head>

<body>
    <header>
        <nav>
            <button type="submit" name="home" value="home" aria-label="Página inicial" onclick="home()">Home</button>
            <button type="submit" name="" value="atendimento" aria-label="">Atendimento</button>
            <button type="submit" name="" value="sobre" aria-label="">Sobre</button>
            <button type="submit" name="" value="perfil" aria-label="Perfil">Perfil</button>
        </nav>
    </header>

    <center>
        <h2>Digite seu email</h2>
        <div id="container">
            <form method="post" autocomplete="on" action="<?php echo htmlspecialchars('atuSenhaphp.php'); ?>">
                <label for="pemail">Email:
                    <input type="email" name="email" id="pemail" placeholder="Email" required>
                </label><br>

                <label for="psenha">Senha:
                    <input type="password" placeholder="No mínimo 8 caracteres com letras e números" name="senha"
                        id="psenha" minlength="8" maxlength="50" required>
                </label><br>


                <input type="submit" name="enviar" id="penviar" value="Verificar"><br>
                <?php
                session_start();
                if (isset($_SESSION['msg'])) {
                    echo "<p style='color: red;'>" . $_SESSION['msg'] . "</p>";
                    unset($_SESSION['msg']);
                }
                ?>
            </form>
        </div>
    </center>
</body>

</html>