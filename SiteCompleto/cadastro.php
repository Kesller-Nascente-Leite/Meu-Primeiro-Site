<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>
    <link rel="stylesheet" href="cadastro.css">

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
            <button type="submit" name="home" value="home"onclick="home()">Home</button>
            <button type="submit" name="" value="Atendimentos" onclick="atendimento()">Atendimentos</button>
            <button type="submit" name="" value="sobre" >Sobre</button>
            <button type="submit" name="perfil" value="perfil">Perfil</button>
        </nav>
    </header>

    <center>
        <h1>Cadastro</h1><br>
        <main>
            <div id="container">
                <!--php no action para prevenir contra ataques XSS
                se coloca o arquivo em que ira enviar dentro do echo htmlspecialchars()-->
                <form method="POST" autocomplete="off" action="<?php echo htmlspecialchars('cadastrophp.php'); ?>">

                    <label for="pnome">Nome do Paciente:
                        <input type="text" placeholder="Nome" name="paciente" id="pnome" minlength="2" maxlength="50"  aria-label="Nome do paciente">

                    </label><br>
                    <label for="pemail">Email:
                        <input type="email" placeholder="Email" name="email" id="pemail"  maxlength="100">
                    </label><br>

                    <label for="psenha">Senha:
                        <input type="password" placeholder="No mínimo 8 caracteres com letras e números" name="senha"
                            id="psenha" minlength="8" maxlength="50" >
                    </label><br>

                    <label for="Data de nascimento">Data de Nascimento
                        <input type="date" name="nascimento" id="pnascimento" >
                    </label><br>

                    <label for="Telefone">Telefone
                        <input type="tel" name="telefone" id="ptel" minlength="14" maxlength="15"   placeholder="XX XXXX-XXXX">

                    </label><br>

                    <label for="sexo">Sexo:</label><br>
                    <select name="sexo" id="sexo">
                        <option value="1">Masculino</option>
                        <option value="2">Feminino</option>
                    </select><br>




                    <input type="submit" name="enviar" id="penviar" value="Cadastrar">

                    <!-- Exibe a mensagem de erro aqui -->
                    <?php
                    session_start();
                    if (isset($_SESSION['msg'])) {
                        echo "<p style='color: red;'>" . $_SESSION['msg'] . "</p>";
                        unset($_SESSION['msg']); // Remove a mensagem após exibi-la
                    }
                    session_write_close()
                    ?>
                </form>
            </div>
        </main>
    </center>

</body>

</html>