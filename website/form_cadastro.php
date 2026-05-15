<?php
require_once 'crud.php';
$erro = $_GET['erro'] ?? null;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="centralizar">
        <form action="insert.php" method="post" class="form-cadastro">
        
            <h1 class="titulo-centralizado">Cadastre-se</h1>

            <label class="label_form">Nome:</label>
            <input type="text" placeholder="Insira o seu nome" name="nome">

            <label class="label_form">CNPJ:</label>
            <input type="text" placeholder="Ex: XX.XXX.XXX/XXXX-XX" name="cnpj">

            <label class="label_form">E-mail:</label>
            <input type="email" placeholder="Insira o seu e-mail" name="email">

            <label class="label_form">Senha:</label>
            <input type="text" placeholder="Insira a sua senha" name="senha">

            <label class="label_form">Confirmar senha:</label>
            <input type="text" placeholder="Confirme sua senha" name="confirmar_senha">
            <?php 
            if($erro == "senha_incorreta") {
                echo '<label class="senha_incorreta">Senha Incorreta</label>';
            }
            ?>

            <input type="checkbox">
            <label class="label_form">Eu concordo com os Termos de Privacidade</label>

            <button type="submit" class="botao_form">Cadastrar</button>
    </div>



    </form>
    
</body>
</html>
