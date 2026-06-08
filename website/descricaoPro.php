    <?php
    $titulo = 'Descrição de produto';
    $css = './css/estoque2.css';
    require_once 'partials/sidebar.php';
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

                <div class="box2">
                    <form class="box3" action="form_update.php" method="GET">
                        <button name="id" value="<?= $id ?>" class="edit" type="submit">Editar produto</button>
                        <a href="estoque.php" class="voltar">Voltar ao estoque</a>
                    </form>
                </div>
            </section>
        </main>
    </body>
    </html>