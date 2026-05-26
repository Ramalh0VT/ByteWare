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
            <form action="insertUsuario.php" method="post" class="form-cadastro">
    
                <h1>Cadastre-se</h1>
                <p class="subtitulo">Crie sua conta gratuitamente</p>
    
                <label for="nome">Empresa:</label>
                <div class="caixaInput">
    
                    <input type="text" id="nome" name="nome" class="inp" placeholder="Digite o nome da empresa" required>
                </div>
    
                <label for="cnpj">CNPJ:</label>
                <div class="caixaInput">
    
                    <input type="text" id="cnpj" name="cnpj" class="inp" placeholder="00.000.000/0000-00" required>
                </div>
    
                <label for="email">E-mail:</label>
                <div class="caixaInput">
                    <input type="email" id="email" name="email" class="inp" placeholder="Informe seu e-mail" required>
                <div class="caixaInput"></div>
    
                <label for="senha">Senha:</label>
                <div class="caixaInput">
    
                <input type="password" id="senha" name="senha" class="inp" placeholder="Crie uma senha" required>
                </div>
    
                <label for="confirmar_senha">Confirmar senha:</label>
                <div class="caixaInput">
    
                <input type="password" id="confirmar_senha" name="confirmar_senha" class="inp" placeholder="Confirme a senha criada" required>
                </div>
    
                <?php
                if($erro == "senha_incorreta") {
                    echo '<label class="senha_incorreta">Senha Incorreta</label>';
                }
                ?>
    
                <div class="termos">
                    <input type="checkbox" required> <span>Eu concordo com os Termos de Privacidade</span>
                </div>
    
                <br>
    
                <div class="redirecionar">
                    <p>Possui cadastro? <a href="#" class="lgn">Acesse aqui</a> </p>
                </div>
                <button type="submit" class="botao_form">Cadastrar</button>
            </form>
        </div>
</main>
    
</body>
</html>