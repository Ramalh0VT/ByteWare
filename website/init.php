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
                <form method="get" action="index.php">
                    <select name="filtro" id="">
                        <option value="0a100">Filtre por preço:</option>
                        <option value="101a300">Preço</option>
                        <option value="301a500">Preço</option>
                        <option value="501a800">Preço</option>
                        <option value="801a1500">Preço</option>
                        <option value="acimaDe1500">Preço</option>
                    </select>
                </form>
            </section>

            
            <section class="filtro">
                <div class="categorias">
                    <h3><a href="index.php">Todos</a></h3>
                    <h3><a href="index.php?filtro=sensor">Sensores</a> </h3>
                    <h3><a href="index.php?filtro=clp">CLPs</a> </h3>
                    <h3><a href="index.php?filtro=ihm">IHMs</a> </h3>
                    <h3><a href="index.php?filtro=rele">Relés</a> </h3>
                    <h3><a href="index.php?filtro=fonte_industrial">Fontes industriais</a> </h3>
                    <h3><a href="index.php?filtro=inversor_frequencia">Inversores de frequência</a> </h3>
                </div>
            </section>
            

            <?php
            if($filtro === null) {
            ?>
                <section class="prateleira">
                    <?php
                    $produtos = readAll($pdo, 'produtos', null);
                    foreach($produtos as $produto) {
                        print '
                        <a href="./infoproduto.php?id='.$produto['id_produto'].'" class="card">
                        <img src="'.$produto['imagem'].'" />
                        <p>'.$produto['nome_produto'].'</p>
                        <p class="preco"><p class="">R$</p>'.number_format((float)$produto['preco'], 2, ',', '.').'</p>
                        </a>';
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
                        print '
                        <a href="./infoproduto.php?id='.$produto['id_produto'].'" class="card">
                        <img src="'.$produto['imagem'].'" />
                        <p>'.$produto['nome_produto'].'</p>
                        <p class="preco"><p class="">R$</p>'.number_format((float)$produto['preco'], 2, ',', '.').'</p>
                        </a>';
                    };
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