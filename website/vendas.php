<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ByteWare</title>
    </head>
    <body>
        <header>
            <nav class="nav">
                <a href="index.php"><img src="./imagens/logo.png" alt="" class="logo"/></a>
                

                <div class="log">
                    <p class="receber">Bem-vindo de volta <b>Victor</b></p>
                    <img src="./imagens/noneperfil.png" alt="" class="perfil"/>
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
