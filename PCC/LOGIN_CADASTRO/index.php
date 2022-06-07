<?php
SESSION_start();
$containerCssAcesso = @$_GET['login'] == 'true' ? 'logar-js' : 'cadastrar-js';
if (@$_COOKIE['continuar_logado']) {
    header('location: ../MEUS_ALERTAS/index.php');
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='utf-8'>
        <title>ACESSE ALERTE</title>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='CSS/Estilo.css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bubbler+One&family=Open+Sans:wght@400;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
        </script>
    </head>

    <body class="<?= $containerCssAcesso ?>">
        <div class="container">
            <div class="content first-content">
                <div class="first-column">
                    <h2 class="title titulo">POR QUE EU DEVO ME CADASTR<br>AR?</h2>
                    <p class="description">
                        Aqui você pode criar alertas levantando vaquinhas e pedidos de ajuda,
                        além de ficar por dentro de tudo sobre a história da comunidade LGBT
                        no Brasil e figuras importantes no nosso cenário atual.
                    </p>
                    <p class="description">
                        Cadastre-se, é rápido, é fácil, é Alerte.
                    </p>
                    <button id="logar" class="btn btn_1">Já possuo conta</button>
                </div>
                <div class="second-column">
                    <h2 class="title title_1">CADASTRE-SE</h2>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
                    <form name="cadastro" action="VALIDAR/validar.php" class="form" method="POST">
                        <input type="text" name="nome" class="input_menor" placeholder="Nome" required>
                        <input type="text" name="sobrenome" class="input_menor" placeholder="Sobrenome" required>
                        <input type="text" name="nome_social" placeholder="Nome social">
                        <input type="text" name="usuario" placeholder="Usuário" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="text" name="cpf" id="input" onkeydown="validarCPF(event)" placeholder="CPF" required>
                        <span id="password-status" class="validar_js"></span>
                        <input type="password" name="senha" id="password" minlength="6" maxlength="15" onKeyUp="validar();" placeholder="Senha" required>
                        <input type="password" name="senha2" id="confirm_password" minlength="6" maxlength="15" placeholder="Confirmar Senha" required><br>
                        <input type="date" name="nascimento" id="nascimento" class="input_menor" placeholder="Nascimento" required>
                        <select name="genero">
                            <option value="Mulher_cis">Mulher cis</option>
                            <option value="Homem_cis">Homem cis</option>
                            <option value="Mulher_trans">Mulher trans</option>
                            <option value="Homem_trans">Homem trans</option>
                            <option value="Não-binário">Não-binário</option>
                            <option value="N_especificar">Não especificar</option>
                        </select><br>
                        <input type="submit" class="btn" id="btn" onclick="validar()" name="btn" value="CADASTRAR">
                    </form>

                </div> <!-- second column-->
            </div> <!-- first content -->

            <div class="content second-content">
                <div class="first-column">
                    <h2 class="title">ALERTE!</h2>
                    <p class="description description_2">Alerte. Sua plataforma de alertas online.</p>
                    <button type="submit" id="cadastrar" class="btn btn_1">Cadastre-se</button>
                </div>
                <div class="second-column">
                    <h2 class="title title_2">Login</h2>
                    <?php
                    if (isset($_SESSION['msg2'])) {
                        echo $_SESSION['msg2'];
                        unset($_SESSION['msg2']);
                    }
                    ?>
                    <form action="VALIDAR/validar_login.php" class="form" name="logar" method="POST">
                        <input type="text" name="usuario" class="input_login" placeholder="Usuário" required>
                        <input type="password" name="senha" class="input_login" placeholder="Senha" required>
                        <a href="#" class="esqueci_senha">Esqueci senha</a>
                        <button type="submit" class="btn btn_2">LOGAR</button>
                    </form>
                </div> <!-- second column-->
            </div><!-- second-content-->
        </div>
        <script src="JS/JavaScript.js"></script>
    </body>

    </html>
<?php
}
