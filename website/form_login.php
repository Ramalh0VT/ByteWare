<?php

    $titulo = 'Byteware';
    $css = './css/login.css';
    require_once 'crud.php';
    require_once 'partials/navbar.php';

$login_invalido = $_GET['erro'] ?? null;
?>



<body>

    <div class="container">
        <form action="init.php" method="post" class="log">

            <h1><i class="bi bi-person"></i>LOGIN</h1>

            <div class="rotulo">
                <i class="bi bi-envelope"></i>
                <label for="email">E-mail</label>
            </div>

            <input type="text" placeholder="Insira o seu e-mail" id="email" name="email-login" class="inp">

            <div class="rotulo">
                <i class="bi bi-lock"></i>
                <label for="senha">Senha</label>
            </div>
            <input type="text" placeholder="Insira a sua senha" id="senha" name="senha-login" class="inp">

            <button type="submit" class="btn">Login</button>
            <?php
            if($login_invalido == 'erro_login'){
                echo '<h3>E-mail ou senha inválidos</h3>';
            }
            elseif($login_invalido =='restrito');
            ?>

            <div class="redirecionar">
                <p>Ainda não se cadastrou? <a href="form_cadastro.php" class="cdt">Acesse aqui</a> </p>
            </div>
        </form>
    </div>
    
</body>
</html>