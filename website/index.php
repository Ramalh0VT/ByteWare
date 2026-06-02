<?php

    $titulo = 'Byteware';
    $css = './css/index.css';
    require_once 'crud.php';
    $filtro = $_GET['filtro'] ?? null;

?>
        <?php
            include 'partials/navbar.php';
        ?>
    <body>


        <main>
            <section class="filtro">
                <section class="ordem">
                    <form method="get" action="index.php">
                        <select name="filtro" class="filtrarPreco">
                            <option value="">Filtrar por Preço</option>
                            <option value="0a500" <?php echo $filtro == '0a500' ? 'selected' : ''; ?>>R$0,00 - R$500,00</option>
                            <option value="500a1000" <?php echo $filtro == '500a1000' ? 'selected' : ''; ?>>R$500,00 - R$1.000,00</option>
                            <option value="1000a1500" <?php echo $filtro == '1000a1500' ? 'selected' : ''; ?>>R$1.000,00 - R$1.500,00</option>
                            <option value="1500a2000" <?php echo $filtro == '1500a2000' ? 'selected' : ''; ?>>R$1.500,00 R$2000,00</option>
                            <option value="acimaDe2000" <?php echo $filtro == 'acimaDe2000' ? 'selected' : ''; ?>>Acima de R$2000,00</option>
                        </select>
                        <button type="submit">Filtrar</button>
                    </form>
                </section>

            
                <section class="categorias">
                        <a href="index.php">
                            <div class="card-cat">
                                <h3>Todos</h3>
                                <img src="./imagens/finder.jpg" alt=""/>
                            </div>
                        </a>
                        <a href="index.php?filtro=sensor">
                            <div class="card-cat">
                                <h3>Sensor</h3>
                                <img src="./imagens/sensor indutivoNBB5.jpg" alt=""/>
                            </div>
                           </a>
                        <a href="index.php?filtro=clp">
                            <div class="card-cat">
                                <h3>CLPs</h3>
                                <img src="./imagens/TM221CE16R.jpg" alt=""/>
                            </div>
                        </a>
                        <a href="index.php?filtro=ihm">
                            <div class="card-cat">
                                <h3>IHMs</h3>
                                <img src="./imagens/Siemens KTP700.jpg" alt=""/>
                            </div>
                        </a>
                        <a href="index.php?filtro=reles">
                            <div class="card-cat">
                                <h3>Relés</h3>
                                <img src="./imagens/schneider_zelio.jpg" alt=""/>
                            </div>
                        </a>
                        <a href="index.php?filtro=fonte_industrial">
                            <div class="card-cat">
                                <h3>Fontes industriais</h3>
                                <img src="./imagens/Fonte Allen.jpg" alt=""/>
                            </div>
                        </a>
                        <a href="index.php?filtro=inversor_frequencia">
                            <div class="card-cat">
                                <h3>Inversores de frequência</h3>
                                <img src="./imagens/WDC.jpg" alt=""/>
                            </div>
                        </a>
                </section>

                <section class="ordem">
                    <form method="get" action="index.php">
                        <select name="filtro" id="">
                            <option value="">Classificar por:</option>
                            <option value="destaque" <?php echo $filtro == 'destaque' ? 'selected' : ''; ?>>Destaque</option>
                            <option value="menor_maior" <?php echo $filtro == 'menor_maior' ? 'selected' : ''; ?>>Preço: Do menor ao maior</option>
                            <option value="maior_menor" <?php echo $filtro == 'maior_menor' ? 'selected' : ''; ?>>Preço: Do maior ao menor</option>
                            <option value="a_z" <?php echo $filtro == 'a_z' ? 'selected' : ''; ?>>Nome: A-Z</option>
                            <option value="z_a" <?php echo $filtro == 'z_a' ? 'selected' : ''; ?>>Nome: Z-A</option>
                        </select>
                        <button type="submit">Ordenar</button>
                    </form>
                </section>

            </section>
            

            <?php
            $condicao = null;


                    if ($filtro == '0a500') {
                $condicao = "preco BETWEEN 0 AND 500";
            } elseif ($filtro == '500a1000') {
                $condicao = "preco BETWEEN 500 AND 1000";
            } elseif ($filtro == '1000a1500') {
                $condicao = "preco BETWEEN 1000 AND 1500";
            } elseif ($filtro == '1500a2000') {
                $condicao = "preco BETWEEN 1500 AND 2000";
            } elseif ($filtro == 'acimaDe2000'){
                $condicao = "preco BETWEEN 2000 AND 10e14";
            }  
            elseif ($filtro == 'destaque') {
                $condicao = "status = 1";
            }
               
             elseif ($filtro == 'menor_maior') {
                $condicao = "1=1 ORDER BY preco ASC";
            } elseif ($filtro == 'maior_menor') {
                $condicao = "1=1 ORDER BY preco DESC";
            } elseif ($filtro == 'a_z') {
                $condicao = "1=1 ORDER BY nome_produto ASC";
            } elseif ($filtro == 'z_a') {
                $condicao = "1=1 ORDER BY nome_produto DESC";
            }

            if($filtro === null || $condicao !== null) {
                ?>
                <section class="prateleira">
                    <?php
                    $produtos = readAll($pdo, 'produtos', $condicao);
                    foreach($produtos as $produto) {
                        if($produto['status'] == 1){
                            print '
                                <div class="card">
                                    <a href="./infoproduto.php?id='.$produto['id_produto'].'">
                                    <img src="'.$produto['imagem'].'" />
                                    <p class="nome_prt">'.$produto['nome_produto'].'</p>
                                    <div class="valor">
                                        <p class="cambio">R$</p>
                                        <p class="preco">'.number_format((float)$produto['preco'], 2, ',', '.').'</p>
                                    </div>
                                    </a>
                            
                                    <p class="add"><a href="validacaoCompras.php?id='.$produto['id_produto'].'">Comprar</a><p>
                                </div>
                                ';
                        }
                    };
                    ?>
                </section>
                <?php
            }

            elseif($filtro == 'sensor' || $filtro == 'clp' || $filtro == 'ihm' || $filtro == 'fonte_industrial' ||  $filtro == 'reles' ||  $filtro == 'inversor_frequencia') {
                $filtroCategoria = $filtro;
                ?>
                <section class="prateleira">
                    <?php
                    $produtos = readAll($pdo, 'produtos', "categoria = '$filtroCategoria'");
                    foreach($produtos as $produto) {
                        if($produto['status'] == 1){
                            print '
                                <div class="card">
                                    <a href="./infoproduto.php?id='.$produto['id_produto'].'">
                                    <img src="'.$produto['imagem'].'" />
                                    <p class="nome_prt">'.$produto['nome_produto'].'</p>
                                    <div class="valor">
                                        <p class="cambio">R$</p>
                                        <p class="preco">'.number_format((float)$produto['preco'], 2, ',', '.').'</p>
                                    </div>
                                    </a>
                            
                                    <p class="add"><a href="validacaoCompras.php?id='.$produto['id_produto'].'">Comprar</a><p>
                                </div>
                                ';
                        }
                        else{
                            print '
                                <div class="card">
                                    <a href="./infoproduto.php?id='.$produto['id_produto'].'">
                                    <img src="'.$produto['imagem'].'" />
                                    <p class="nome_prt">'.$produto['nome_produto'].'</p>
                                    <div class="valor">
                                        <p class="cambio">R$</p>
                                        <p class="preco">'.number_format((float)$produto['preco'], 2, ',', '.').'</p>
                                    </div>
                                    </a>
                            
                                    <p class="add"><a href="validacaoCompras.php?id='.$produto['id_produto'].'">Comprar</a><p>
                                </div>
                                ';
                        }
                    }
                    ?>
                </section>
                <?php
            }
                ?>
        </main>

        <?php
        require_once 'partials/footer.php';
        ?>
    </body>
</html>