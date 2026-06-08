<?php
session_start();
require_once 'crud.php';

$pagina = 'estoque';
$titulo = 'Carrinho de Compras';
$css = './css/carrinho.css';
require_once 'partials/navbar.php';


// Quando o cliente clicar em comprar vai mandar o id via get, aqui vai verificar se recebeu ou não, se recebeu vai guardar o valor
$idParaAdicionar = filter_input(INPUT_GET, 'id_produto', FILTER_VALIDATE_INT) ?: filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if($idParaAdicionar){
    $id = $idParaAdicionar;
    if(isset($_SESSION['produtos'][$id])){
        $estoque = (int)$_SESSION['produtos'][$id]['estoque'];
        if($_SESSION['produtos'][$id]['quantidade'] < $estoque){
            $_SESSION['produtos'][$id]['quantidade']++;
        }
    } else {
        $produto = read($pdo, 'produtos', 'id_produto = '.$id);
        if($produto){
            $produto['quantidade'] = 1;
            $_SESSION['produtos'][$id] = $produto;
        }
    }
}

// Parte que vai verificar se veio o id para editar a quantidade do produto e a ação no get
if(isset($_GET['id_alterar']) && isset($_GET['acao'])){
    $id_alterar = $_GET['id_alterar'];
    $acao = $_GET['acao'];

    // Pronto, agora vai ter a verificação para saber se o produto está salvo no session para evitar erros
    if(isset($_SESSION['produtos'][$id_alterar])){
        // Se existir:
        $estoque = (int)$_SESSION['produtos'][$id_alterar]['estoque'];
        
        if($acao == 'mais'){
            if($_SESSION['produtos'][$id_alterar]['quantidade'] < $estoque) {
                $_SESSION['produtos'][$id_alterar]['quantidade'] ++;
                
            }
        }
        elseif($acao == 'menos'){
            if($_SESSION['produtos'][$id_alterar]['quantidade'] > 1) {
                $_SESSION['produtos'][$id_alterar]['quantidade'] --;
            }
        }
    }
}

if(isset($_GET['remover']) && isset($_GET['id_remover'])){
    $deletar = $_GET['remover'];
    $id_deletar = $_GET['id_remover'];

    if($deletar == 'remover'){
        unset($_SESSION['produtos'][$id_deletar]);
    }
}



?>



<body>
    <main>
        <div class="carrinho">
            <div class="produtos">
                <?php
                $totalItens = 0;
                $subtotal = 0;

                if(!empty($_SESSION['produtos'])){
                    foreach($_SESSION['produtos'] as $id_produto => $produto){
                        $itemTotal = $produto['preco'] * $produto['quantidade'];
                        $totalItens += $produto['quantidade'];
                        $subtotal += $itemTotal;
                    ?>
                        <div class="produto">
                            <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome_produto']); ?>">
                            <div class="informacoes">
                                <h2><?php echo htmlspecialchars($produto['nome_produto']); ?></h2>
                                <div class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></div>
                                <div class="acoes">
                                    <form method="get" action="carrinho.php" class="quantidade-form">
                                        <input type="hidden" name="id_alterar" value="<?php echo $id_produto; ?>">
                                        <input type="number" name="valor" min="1" value="<?php echo $produto['quantidade']; ?>" readonly>
                                        <button type="submit" name="acao" value="mais" class="btn">+</button>
                                        <button type="submit" name="acao" value="menos" class="btn">-</button>
                                        
                                    </form>
                                    <a class="remover" href="carrinho.php?remover=remover&id_remover=<?php echo $id_produto?>">Remover</a>
                                </div>
                                <div class="item-total">Total: R$ <?php echo number_format($itemTotal, 2, ',', '.'); ?></div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    echo '<div class="vazio">Seu carrinho está vazio. Continue comprando e adicione produtos.</div>';
                }
                ?>
            </div>
            <div class="resumo">
                    <h2>Resumo da Compra</h2>
                    <div class="linha">
                        <span>Itens no carrinho</span>
                        <span><?php echo $totalItens ?? 0; ?></span>
                    </div>
                    <div class="linha">
                        <span>Total Parcial</span>
                        <span>R$ <?php echo number_format($subtotal ?? 0, 2, ',', '.'); ?></span>
                    </div>
                    <div class="linha">
                        <span>Frete</span>
                        <span>Grátis</span>
                    </div>
                    <div class="total">
                        Total: R$ <?php echo number_format($subtotal ?? 0, 2, ',', '.'); ?></div>
                    <div class="resumo-acoes">
                        <a href="index.php" class="continuar">Continuar comprando</a>
                        <?php if (empty($_SESSION['produtos'])): ?>
                            <button type="button" class="finalizar" disabled>Ir para pagamento</button>
                        <?php else: ?>
                            <a href="pagamento.php" class="finalizar">Ir para pagamento</a>
                        <?php endif; ?>
                    </div>
            </div>
        </div>

        <div class="recomendados">
            <h2>Produtos Recomendados</h2>
                <section class="prateleira">
                    <?php
                    $produtos = readAll($pdo, 'produtos', null, null, null, null, $limit = 5);
                    foreach($produtos as $produto) {
                        if($produto['status'] == 1){
                            print '
                                <div class="card">
                                    <a href="./infoproduto.php?id='.$produto['id_produto'].'">
                                    <img src="'.$produto['imagem'].'" />
                                    <div class="order">
                                        <p class="nome_prt">'.$produto['nome_produto'].'</p>
                                        <div class="valor">
                                            <p class="cambio">R$</p>
                                            <p class="preco">'.number_format((float)$produto['preco'], 2, ',', '.').'</p>
                                        </div>
                                        </a>
                                        <p class="add"><a href="carrinho.php?id_produto='.$produto['id_produto'].'">Adicionar ao carrinho</a></p>
                                    </div>
                                </div>
                                ';
                        }

                    };
                    ?>
                </section>
        </div>
    </main>

        <footer>
            <?php
            require_once 'partials/footer.php';
            ?>
        </footer>
</body>

</html>