<?php
require_once 'crud.php';
$filtro = $_GET['filtro'] ?? null;
$titulo = 'Teste';
$css = './css/index.css';
require_once 'partials/navbar.php';

?>


<body>
    <main>
        <section class="filtro">
            <div class="categorias">
                <h3><a href="prototipoForeach.php?filtro=sensor">Sensores</a> </h3>
                <h3><a href="prototipoForeach.php?filtro=clp">CLPs</a> </h3>
                <h3><a href="prototipoForeach.php?filtro=ihm">IHMs</a> </h3>
                <h3><a href="prototipoForeach.php?filtro=rele">Relés</a> </h3>
                <h3><a href="prototipoForeach.php?filtro=fonte_industrial">Fontes industriais</a> </h3>
                <h3><a href="prototipoForeach.php?filtro=inversor_frequencia">Inversores de frequência</a> </h3>
            </div>
        </section>
    <?php


        if($filtro === null) {
            ?>
            <section class="prateleira">
                <?php
                $produtos = readAll($pdo, 'produtos', null);
                foreach($produtos as $produto) {
                    if($produto['status'] == 1){}
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

    

        if($filtro == 'sensor' || $filtro == 'clp' || $filtro == 'ihm' || $filtro == 'fonte_industrial' ||  $filtro == 'reles' ||  $filtro == 'inversor_frequencia') {
            $filtroCategoria = $filtro;
            ?>
            <section class="prateleira">
                <?php
                $produtos = readAll($pdo, 'produtos', "categoria = '$filtroCategoria'");
                // Aqui vai printar apenas os produtos que estão ativos
                foreach($produtos as $produto) {
                    if($produto['status'] == 1){
                        print '
                            <a href="./infoproduto.php?id='.$produto['id_produto'].'" class="card">
                            <img src="'.$produto['imagem'].'" />
                            <p>'.$produto['nome_produto'].'</p>
                            <p class="preco"><p class="">R$</p>'.number_format((float)$produto['preco'], 2, ',', '.').'</p>
                            </a>';
                    }
                    // Aqui vai printar o que está inativo
                    else{
                        print '
                            <a href="./infoproduto.php?id='.$produto['id_produto'].'" class="card">
                            <img src="'.$produto['imagem'].'" />
                            <p>inativo</p>
                            <p class="preco"><p class="">R$</p>'.number_format((float)$produto['preco'], 2, ',', '.').'</p>
                            </a>';
                    }
                }
                ?>
            </section>
            <?php
        }
        ?>
    </main>
            <?php
        
        ?>
        </body>





