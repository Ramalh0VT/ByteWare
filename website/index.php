<?php

    $titulo = 'Byteware';
    $css = './css/index.css';
    require_once 'crud.php';
    $filtro = $_GET['filtro'] ?? null;
    $search = trim($_GET['search'] ?? '');

?>
        <?php
            include 'partials/navbar.php';
        ?>
    <body>


        <main>
            <section class="filtro">
                <section class="ordem">
                    <form method="get" action="index.php" class="fp">
                        <select name="filtro" class="filtrarPreco">
                            <option value="0">Filtrar por Preço</option>
                            <option value="0a500" <?php echo $filtro == '0a500' ? 'selected' : ''; ?>>R$0,00 - R$500,00</option>
                            <option value="500a1000" <?php echo $filtro == '500a1000' ? 'selected' : ''; ?>>R$500,00 - R$1.000,00</option>
                            <option value="1000a1500" <?php echo $filtro == '1000a1500' ? 'selected' : ''; ?>>R$1.000,00 - R$1.500,00</option>
                            <option value="1500a2000" <?php echo $filtro == '1500a2000' ? 'selected' : ''; ?>>R$1.500,00 R$2000,00</option>
                            <option value="acimaDe2000" <?php echo $filtro == 'acimaDe2000' ? 'selected' : ''; ?>>Acima de R$2000,00</option>
                        </select>
                        <?php if ($search !== ''): ?>
                            <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <?php endif; ?>
                        <button type="submit" class="ft">Filtrar</button>
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
                    <form method="get" action="index.php" class="fp">
                        <select name="filtro" id="" class="filtrarPreco">
                            <option selected value="0">Classificar por:</option>
                            <option value="destaque" <?php echo $filtro == 'destaque' ? 'selected' : ''; ?>>Destaque</option>
                            <option value="menor_maior" <?php echo $filtro == 'menor_maior' ? 'selected' : ''; ?>>Preço: Do menor ao maior</option>
                            <option value="maior_menor" <?php echo $filtro == 'maior_menor' ? 'selected' : ''; ?>>Preço: Do maior ao menor</option>
                            <option value="a_z" <?php echo $filtro == 'a_z' ? 'selected' : ''; ?>>Nome: A-Z</option>
                            <option value="z_a" <?php echo $filtro == 'z_a' ? 'selected' : ''; ?>>Nome: Z-A</option>
                        </select>
                        <?php if ($search !== ''): ?>
                            <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <?php endif; ?>
                        <button type="submit" class="ob">Ordenar</button>
                    </form>
                </section>

            </section>
            

            <?php
            $whereClauses = ['status = 1'];
            $orderClause = '';

            if ($search !== '') {
                $safeSearch = addslashes($search);
                $whereClauses[] = "(nome_produto LIKE '%$safeSearch%' OR descricao LIKE '%$safeSearch%' OR categoria LIKE '%$safeSearch%')";
            }

            if ($filtro == '0') {
                $whereClauses[] = "preco BETWEEN 0 AND 10e14";
            } elseif ($filtro == '0a500') {
                $whereClauses[] = "preco BETWEEN 0 AND 500";
            } elseif ($filtro == '500a1000') {
                $whereClauses[] = "preco BETWEEN 500 AND 1000";
            } elseif ($filtro == '1000a1500') {
                $whereClauses[] = "preco BETWEEN 1000 AND 1500";
            } elseif ($filtro == '1500a2000') {
                $whereClauses[] = "preco BETWEEN 1500 AND 2000";
            } elseif ($filtro == 'acimaDe2000') {
                $whereClauses[] = "preco BETWEEN 2000 AND 10e14";
            } elseif ($filtro == 'destaque') {
                $whereClauses[] = "status = 1";
            } elseif (in_array($filtro, ['sensor', 'clp', 'ihm', 'reles', 'fonte_industrial', 'inversor_frequencia'])) {
                $safeCategory = addslashes($filtro);
                $whereClauses[] = "categoria = '$safeCategory'";
            }

            if ($filtro == 'menor_maior') {
                $orderClause = 'ORDER BY preco ASC';
            } elseif ($filtro == 'maior_menor') {
                $orderClause = 'ORDER BY preco DESC';
            } elseif ($filtro == 'a_z') {
                $orderClause = 'ORDER BY nome_produto ASC';
            } elseif ($filtro == 'z_a') {
                $orderClause = 'ORDER BY nome_produto DESC';
            }

            $where = implode(' AND ', $whereClauses);
            if ($orderClause) {
                $where .= ' ' . $orderClause;
            }

            $produtos = readAll($pdo, 'produtos', $where);
            ?>
                <section class="prateleira">
                    <?php
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
                                        <a href="carrinho.php?id_produto='.$produto['id_produto'].'" class="add">Comprar</a>
                                    </div>
                                </div>
                                ';
                        }
                    };
                    ?>
                </section>
            <?php
            ?>
        </main>

        <?php
        require_once 'partials/footer.php';
        ?>
    </body>
</html>