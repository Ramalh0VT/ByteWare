<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ByteWare</title>
        <link rel="stylesheet" href="./css/global.css">
        <link rel="stylesheet" href="./css/index.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    </head>
    <body>
        <header>
            <nav class="nav">
                <a href="vendas.php"><img src="./imagens/logo.png" alt="" class="logo"/></a>
                <a href="vendas.php" class="nome">ByteWare</a>
                <a href="vendas.php" class="carrinho"><i class="bi bi-cart3"></i></a>

                <div class="log">
                    <a href="login.php" class="logi"><i class="bi bi-person-fill">login</i></a>
                    <a href="form_cadastro.php" class="cad"><i class="bi bi-person-plus-fill">Cadastro</i></a>
                    
                </div>
            </nav>
        </header>
        <header>
            <nav class="side">
                <ul class="link">
                    <a href="index.php" class="<?= $pagina == 'destaque' ? 'active' : '' ?>">Destaque</a>
                    <a href="insert.php" class="<?= $pagina == 'add' ? 'active' : '' ?>">Nova Música</a>
                </ul>
            </nav>
        </header>
    </body>
</html>
