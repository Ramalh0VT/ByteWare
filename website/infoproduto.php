<?php
$titulo = 'Descrição de produto';
$css = './css/estoque2.css';
require_once 'partials/navbar.php';
require_once 'crud.php';

$mensagemSucesso = null;
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: estoque.php?erro=erro_linkinvalido');
    exit;
}

$produto = read($pdo, 'produtos', 'id_produto = '.$id);

if (!$produto) {
    header('Location: estoque.php?erro=erro_linkinvalido');
    exit;
}

$desc = (!empty($produto['descricao'])) ? $produto['descricao'] : 'Este produto não possui descrição.';
?>
<body>
    <main>
        <section class="box">
            <div class="header-info">
                <div>
                    <h1 class="produto-titulo"><?= htmlspecialchars($produto['nome_produto']) ?></h1>
                    <p class="subtitulo">Conheça mais sobre este produto e veja todos os detalhes antes de continuar.</p>
                </div>
                <span class="etiqueta">Categoria: <?= htmlspecialchars($produto['categoria']) ?></span>
            </div>

            <div class="info">
                <figure class="image-wrapper">
                    <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem de <?= htmlspecialchars($produto['nome_produto']) ?>">
                </figure>

                <div class="desc">
                    <div class="descricao-card">
                        <h2>Descrição</h2>
                        <p><?= htmlspecialchars($desc) ?></p>
                    </div>

                    <div class="detalhes">
                        <div class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></div>
                        <div class="info-meta">
                            <span><strong>ID:</strong> <?= htmlspecialchars($produto['id_produto']) ?></span>
                            <span><strong>Tipo:</strong> <?= htmlspecialchars($produto['categoria']) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($mensagemSucesso): ?>
                <div class="mensagem-sucesso"><?= htmlspecialchars($mensagemSucesso) ?></div>
            <?php endif; ?>

            <div class="box2">
                <form class="box3" action="carrinho.php?id=<?= $id ?>" method="POST">
                    <button type="submit" name="acao" value="adicionar" class="edit">Adicionar ao carrinho</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>