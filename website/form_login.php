<?php
require_once 'crud.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="insert.php" method="post" class="form-login">

        <h1 class="titulo centralizado">Login</h1>

        <label class="label_form">E-mail</label>
        <input type="text" placeholder="Insira o seu E-mail" name="email">

        <label class="label_form">Senha</label>
        <input type="text" placeholder="Insira a sua senha" name="senha">
        
    </form>
    
</body>
</html>
