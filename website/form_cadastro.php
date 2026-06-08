<?php

    $titulo = 'Byteware';
    $css = './css/user.css';
    require_once 'crud.php';
    require_once 'partials/navbar.php';

$erro = $_GET['erro'] ?? null;
?>


<body>

<main>
    
        <div class="container">
            <form action="process/insertUsuario.php" method="post" class="form-cadastro">
    
                <h1>Cadastre-se</h1>
                <p class="subtitulo">Crie sua conta gratuitamente</p>
    
                <label for="nome">Empresa:</label>
                <div class="caixaInput">
    
                    <input type="text" id="nome" maxlength="200" name="nome" class="inp" placeholder="Digite o nome da empresa" required>
                </div>
    
                <label for="cnpj">CNPJ:</label>
                <div class="caixaInput">
    
                    <input type="text" id="cnpj" name="cnpj" maxlength="18" class="inp" placeholder="00.000.000/0000-00" required>
                </div>
    
                <label for="email">E-mail:</label>
                <div class="caixaInput">
                    <input type="email" id="email" name="email" class="inp" maxlength="500" placeholder="Informe seu e-mail" required>
                <div class="caixaInput"></div>
    
                <label for="senha">Senha:</label>
                <div class="caixaInput">
    
                <input type="password" id="senha" name="senha" class="inp" maxlength="1000" placeholder="Crie uma senha" required>
                </div>
    
                <label for="confirmar_senha">Confirmar senha:</label>
                <div class="caixaInput">
    
                <input type="password" id="confirmar_senha" name="confirmar_senha" maxlength="1000" class="inp" placeholder="Confirme a senha criada" required>
                </div>
    
                <?php
                if($erro == "senha_incorreta") {
                    echo '<label class="senha_incorreta">Senha Incorreta</label>';
                }
                ?>
                <div class="termos">
                    <input type="checkbox" required> <span>Eu concordo com os Termos de Privacidade</span>
                </div>
                <div class="redirecionar">
                    <p>Possui cadastro? <a href="./form_login.php" class="lgn">Acesse aqui</a> </p>
                </div>
                <button type="submit" class="botao_form">Cadastrar</button>
            </form>
        </div>
</main>
</body>
</html>