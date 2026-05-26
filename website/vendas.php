<?php

    $titulo = 'Byteware';
    $css = './css/index.css';
    require_once 'crud.php';
?>
    <body>

        <?php
            include 'partials/navbar.php';
            
        ?>
        <main>
            <section class="filtro">
                <ul class="filtro">
                    <a href="?"  class="todos">Todos</a>
                </ul>
            </section>


            <section class="prateleira">
                <?php
                $produtos = readAll($pdo, 'produtos', null);
                foreach($produtos as $produto) {
                    print '
                            <a href="./infoproduto.php?id='.$produto['id_produto'].'" class="card">
                            <img src="'.$produto['imagem'].'" />
                            <p>'.$produto['nome_produto'].'</p>

                            <p class="preco"><p class="">R$</p>'.number_format((float)$produto['custo'], 2, ',', '.').'</p>
                            
                            </a>';
                        };
                ?>
            </section>
        </main>

    </body>
</html>