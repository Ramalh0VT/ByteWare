<?php
$titulo = 'Descrição de produto';
$css = './css/estoque2.css';
require_once 'partials/navbar.php';
require_once 'crud.php';

$produtos = readAll($pdo, 'produtos');
$id = null;

if(isset($_GET['p_editar'])){
    $id = $_GET['p_editar'];
    $dar_erro = true;
    foreach($produtos as $produto){
        if($id == $produto['id_produto']){
            $dar_erro = false;
        }
    }
    if ($dar_erro === true){
        header('Location: estoque.php?erro=erro_linkinvalido');
        die();  
    }
} else {
    header('Location: estoque.php?erro=erro_linkinvalido');
    die();
}

$produto = read($pdo, 'produtos', 'id_produto ='.$id);
$desc = (isset($produto['descricao']) && !empty($produto['descricao'])) ? $produto['descricao'] : 'Este produto não possui descrição.';

?>
<body>
    <main>
        <div class="box">
            <h1 class="margem_baixo"><?= $produto['nome_produto'] ?></h1>
            <div class="info">
                <img src="<?= $produto['imagem'] ?>" alt="Imagem do Produto">
                <div class="desc">
                    <p><?= $desc ?></p>
                    <div class="abaixo">
                        <p>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                        <p>Tipo: <?= $produto['categoria'] ?></p>
                    </div>
                </div>
            </div>

            <div class="box2">
                <form class="box3" action="form_update.php" method="GET">
                    <button name="id" value="<?= $id ?>" class="edit" type="submit">Editar produto</button>
                    <a href="estoque.php" class="voltar">Voltar ao estoque</a>
                </form>
            </div>
        </div>
    </main>
</body>
</html>