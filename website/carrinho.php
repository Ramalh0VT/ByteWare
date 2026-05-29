<?php
require_once 'crud.php';

$pagina = 'estoque';

$titulo = 'Carrinho de Compras';
$css = './css/carrinho.css';
require_once 'crud.php';
require_once 'partials/navbar.php';

?>


<body>
    <main>
        <div class="carrinho">
            <div class="produtos">
                <div class="produto">
                    <img src="imagens/sensorE3.jpg" width="10" height="10">
                    <div class="informacoes">
                        <h2>Parafuso</h2>
                        <p>Parafuso philips</p>
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
                        <p>Parafuso philips</p>
                        <div class="preco">
                            R$470.00
                        </div>
                        <div class="acoes">
                            <form method="POST" action="carrinho.php" style="display: flex; align-items: center; gap: 10px; flex-direction: row;">
                                <input type="hidden" name="id" value="'.$estoque['id'].'">
                                <input type="number" name="valor" min="1" value="1">
                                
                                <button type="submit" name="acao" value="mais" class="btn-icon btn-plus">+</button>

                                <button type="submit" name="acao" value="menos" class="btn-icon btn-minus">-</button>
                            </form>
                            <button>Remover</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="resumo">
                <h2>Resumo da Compra</h2>
                <div class="linha">
                    <span>Total Parcial:</span>
                    <span>qtd * preço</span>
                </div>
        
                <div class="linha">
                    <span>Frete:</span>
                    <span>Grátis</span>
                </div>
                <div class="linha">
                    <span>Total:</span>
                    <span>Total Parcial + Frete(sempre grátis)</span>
                </div>
                <button class="finalizar">Finalizar Compra</button>
            </div>
        </div>

        <div class="recomendados">
            <h2>Produtos Recomendados</h2>
            <div class="gridProd">
                <div class="card">
                    <img src="#">
                    <h3>Produto de Teste</h3>
                    <p class="preco_card">R$00.00</p>
                    <button>Comprar</button>
                </div>

                <div class="card">
                    <img src="#">
                    <h3>Produto de Teste 2</h3>
                    <p class="preco_card">R$00.00</p>
                    <button>Comprar</button>
                </div>
            </div>
        </div>
    </main>

        <?php
        require_once 'partials/footer.php';
        ?>
</body>

</html>