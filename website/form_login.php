<?php

    $titulo = 'Byteware';
    $css = './css/login.css';
    require_once 'crud.php';
    require_once 'partials/navbar.php';

$login_invalido = $_GET['erro'] ?? null;
?>



<body>

    <div class="container">
        <form action="process/init.php" method="post" class="log">

            <h1><i class="bi bi-person"></i>LOGIN</h1>

            <div class="rotulo">
                <i class="bi bi-envelope"></i>
                <label for="email">E-mail</label>
            </div>

            <input type="text" placeholder="Insira o seu e-mail" id="email" maxlength="500" name="email-login" class="inp">

            <div class="rotulo">
                <i class="bi bi-lock"></i>
                <label for="senha">Senha</label>
            </div>
            <input type="password" placeholder="Insira a sua senha" id="senha" name="senha-login" maxlength="1000" class="inp" autocomplete="current-password">

            <button type="submit" class="btn">Login</button>
            <?php
            if ($login_invalido === 'erro_login') {
                echo '<h3>E-mail ou senha inválidos</h3>';
            } elseif ($login_invalido === 'restrito') {
                echo '<h3>Acesso restrito. Faça login primeiro.</h3>';
            }
            ?> 
            <div class="redirecionar">
                <p>Ainda não se cadastrou? <a href="form_cadastro.php" class="cdt">Acesse aqui</a></p>
            </div>
        </form>
    </div>
    
</body>
</html>