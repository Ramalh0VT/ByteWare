<?php
require_once 'crud.php';
?>

<?php
require_once 'crud.php';
$id = $_GET['id'] ?? null;
$editarProduto = read($pdo, 'produtos', )
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
        <form action="insertUsuario.php" method="post" class="form-cadastro">
        
            <h1 class="titulo-centralizado">Edição</h1>

            <label class="label_form">Nome:</label>
            <input type="text" value=" <?php echo $editarProduto['nome_produto']; ?> " name="nome">

            <label class="label_form">PN:</label>
            <input type="text" value=" <?php echo $editarProduto['nome_produto']; ?>" name="cnpj">

            <label class="label_form">Estoque:</label>
            <input type="email" value=" <?php echo $editarProduto['nome_produto']; ?>" name="email">

            <label class="label_form">Custo:</label>
            <input type="text" value=" <?php echo $editarProduto['nome_produto']; ?>" name="senha">

            <label class="label_form">Categoria:</label>
            <input type="text" value=" <?php echo $editarProduto['nome_produto']; ?>" name="confirmar_senha">

            <label class="label_form">Status:</label>
            <input type="text" value=" <?php echo $editarProduto['nome_produto']; ?>" name="confirmar_senha">
            

            <label class="direcionar"><a href="form_login.php"> Possui cadastro? Acesse aqui </a></label>

            <button type="submit" class="botao_form">Cadastrar</button>
    </div>



    </form>
    
</body>
</html>
