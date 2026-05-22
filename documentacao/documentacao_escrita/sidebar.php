        <header class="side">
            <div class="col">
                <a href="vendas.php"><img src="./imagens/logo.png" alt="" class="logo"/></a>
                <a href="vendas.php" class="nome">ByteWare</a>
            </div>
        <nav class="ancoras">
            <a href="index.php" class="<?= $pagina == 'estoque' ? 'active' : '' ?>"><i class="bi bi-table"></i>Painel de Estoque</a>
            <a href="cadastro.php" class="<?= $pagina == 'cadastrar' ? 'active' : '' ?>"><i class="bi bi-clipboard-plus-fill"></i>Cadastrar Produto</a>
            <a href="financeiro.php" class="<?= $pagina == 'financeiro' ? 'active' : '' ?>"><i class="bi bi-bar-chart-line-fill"></i>Visão Geral</a>
        </nav>
        </header>