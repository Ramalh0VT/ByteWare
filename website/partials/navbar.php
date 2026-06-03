<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$showButtons = true;
$username = null;
if (isset($_SESSION['admLogado'])) {
    $showButtons = false;
    $username = $_SESSION['admLogado']['nome'] ?? 'Administrador';
} elseif (isset($_SESSION['clienteLogado'])) {
    $showButtons = false;
    $username = $_SESSION['clienteLogado']['nome'] ?? 'Cliente';
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo ?? 'Loja' ?></title>
        <link rel="stylesheet" href="./css/global.css">
        <?php if (!empty($css)): ?><link rel="stylesheet" href="<?php echo $css?>"><?php endif; ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    </head>


        <header>
            <nav class="nav">
                <div class="line">
                    <a href="index.php"><img src="./imagens/logo.png" alt="" class="logo"/></a>
                    <a href="index.php" class="nome">ByteWare</a>
                </div>

                <form action="" class="pesquisa">
                    <input type="text" placeholder="Pesquisar ByteWare">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
                
                <a href="carrinho.php" class="carrinhos"><i class="bi bi-cart3"></i></a>

                <?php if ($showButtons): ?>
                    <div class="logn">
                        <a href="form_login.php" class="logi"><i class="bi bi-person-fill"></i><p>Login</p></a>
                        <a href="form_cadastro.php" class="cad"><i class="bi bi-person-plus-fill"></i><p>Cadastro</p></a>
                    </div>
                <?php else: ?>
                    <div class="user">
                        <div class="perfil">
                            <img src="./imagens/usernulo.png" alt="" class="foto">
                            <h3 class="name"><?php echo htmlspecialchars($username); ?></h3>
                        </div>
                        <div class="sair">
                            <a href="logout.php" title="Sair"><i class="bi bi-box-arrow-left"></i></a>
                        </div>
                    </div>
                <?php endif; ?>
            </nav>
        </header>
<?php
require_once 'login_check.php';
$aparecer = false;
if(!isset($login)){
    $aparecer = true;
}
$botoes = null;
if($aparecer === true){
	$botoes = '<div class="logn">
                    <a href="form_login.php" class="logi"><i class="bi bi-person-fill"></i><p>Login</p></a>
                    <a href="form_cadastro.php" class="cad"><i class="bi bi-person-plus-fill"></i><p>Cadastro</p></a>
        
                </div>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo ?></title>
        <link rel="stylesheet" href="./css/global.css">
        <link rel="stylesheet" href="<?php echo $css?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    </head>


        <header>
            <nav class="nav">
                <div class="line">
                    <a href="index.php"><img src="./imagens/logo.png" alt="" class="logo"/></a>
                    <a href="index.php" class="nome">ByteWare</a>
                </div>

                <form action="" class="pesquisa">
                    <input type="text" placeholder="Pesquisar ByteWare">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
                
                <a href="carrinho.php" class="carrinhos"><i class="bi bi-cart3"></i></a>

		<?=$botoes?>
                <div class="user">
                    <div class="perfil">
                        <img src="./imagens/usernulo.png" alt="" class="foto">
                        <h3 class="name">Victor123</h3>
                    </div>
                    <div class="sair">
                        <i class="bi bi-box-arrow-left"></i>
                    </div>
                </div>
            </nav>
        </header>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo ?></title>
        <link rel="stylesheet" href="./css/global.css">
        <link rel="stylesheet" href="<?php echo $css?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    </head>


        <header>
            <nav class="nav">
                <div class="line">
                    <a href="index.php"><img src="./imagens/logo.png" alt="" class="logo"/></a>
                    <a href="index.php" class="nome">ByteWare</a>
                </div>

                <form action="" class="pesquisa">
                    <input type="text" placeholder="Pesquisar ByteWare">
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
                
                <a href="carrinho.php" class="carrinhos"><i class="bi bi-cart3"></i></a>

                <div class="logn">
                    <a href="form_login.php" class="logi"><i class="bi bi-person-fill"></i><p>Login</p></a>
                    <a href="form_cadastro.php" class="cad"><i class="bi bi-person-plus-fill"></i><p>Cadastro</p></a>
                    
                </div>

                <div class="user">
                    <div class="p">
                        <img src="./imagens/usernulo.png" alt="" class="foto">
                        <h3 class="name">Victor123</h3>
                    </div>
                    <div class="sair">
                        <i class="bi bi-box-arrow-left"></i>
                    </div>
                </div>
            </nav>
        </header>