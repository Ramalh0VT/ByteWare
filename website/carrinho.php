<?php
session_start();
require_once 'crud.php';

$pagina = 'estoque';
$titulo = 'Carrinho de Compras';
$css = './css/carrinho.css';
require_once 'crud.php';
require_once 'partials/navbar.php';


// Parte que vai receber o id do produto e colocar ele na session

$produtos = read($pdo, 'produtos');

if(!isset($_SESSION['quantidadeDesejada'])){
    $_SESSION['quantidadeDesejada'] = 1;
}

if(isset($_GET['acao'])){
    $acao = $_GET['acao'];


    if($acao == 'mais'){
        $_SESSION['quantidadeDesejada'] += 1;
    }

    elseif($acao == 'menos'){
        if($_SESSION['quantidadeDesejada'] > 1){
            $_SESSION['quantidadeDesejada'] -= 1;
        }
    }
    header("Location: carrinho.php");
    exit;
}
?>



<body>
    <main>
        <div class="carrinho">
            <div class="produtos">
                <div class="produto">
                    <img src="imagens/sensorE3.jpg" width="10" height="10">
                    <div class="informacoes">
                        <h2>Parafuso</h2>
                        <div class="preco">
                            R$470.00
                        </div>
                        <div class="acoes">
                            <button>Remover</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="produto">
                    <img src="imagens/sensorE3.jpg" width="10" height="10">
                    <div class="informacoes">
                        <h2>Parafuso</h2>
                        <div class="preco">
                            R$470.00
                        </div>
                        <div class="acoes">
                            <form method="get" action="carrinho.php" style="display: flex; align-items: center; gap: 10px; flex-direction: row;">
                                <input type="hidden" name="id" value="'.$estoque['id'].'">
                                
                                <input type="number" name="valor" min="1" value="<?php echo $_SESSION['quantidadeDesejada']; ?>">
                                
                                <button type="submit" name="acao" value="mais" class="btn">+</button>

                                <button type="submit" name="acao" value="menos" class="btn">-</button>
                            </form>
                            <button class="remover">Remover</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="resumo">
                <form action="pagamento.php" method="post">
                    <h2>Resumo da Compra</h2>
                    <div class="linha">
                        <span>Total Parcial:</span>
                        <span>qtd * preço</span>
                    </div>
            
                    <div class="linha">
                        <span>Frete:</span>
                        <span>Grátis</span>
                    </div>
                    <div class="total">
                        <span>Total: R$00.00</span>
                    </div>
                    <button type="submit" class="finalizar">Finalizar Compra</button>
                </form>
            </div>
        </div>

        <div class="recomendados">
            <h2>Produtos Recomendados</h2>
            <div class="gridProd">
                <div class="card">
                    <img src="imagens/sensorE3.jpg">
                    <h3>Produto de Teste</h3>
                    <p class="preco_card">R$00.00</p>
                    <button>Comprar</button>
                </div>

                <div class="card">
                    <img src="imagens/sensorE3.jpg">
                    <h3>Produto de Teste 2</h3>
                    <p class="preco_card">R$00.00</p>
                    <button>Comprar</button>
                </div>

                <div class="card">
                    <img src="imagens/sensorE3.jpg">
                    <h3>Produto de Teste 2</h3>
                    <p class="preco_card">R$00.00</p>
                    <button>Comprar</button>
                </div>

                <div class="card">
                    <img src="imagens/sensorE3.jpg">
                    <h3>Produto de Teste 2</h3>
                    <p class="preco_card">R$00.00</p>
                    <button>Comprar</button>
                </div>

                <div class="card">
                    <img src="imagens/sensorE3.jpg">
                    <h3>Produto de Teste 2</h3>
                    <p class="preco_card">R$00.00</p>
                    <button>Comprar</button>
                </div>
            </div>
        </div>
    </main>

        <footer>
            <?php
            require_once 'partials/footer.php';
            ?>
        </footer>
</body>

</html>
