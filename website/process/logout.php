<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_GET['logout']) && $_GET['logout'] === 'logout') {
    if (isset($_SESSION['admLogado']) && !empty($_SESSION['admLogado'])) {
        unset($_SESSION['admLogado']);
    }

    if (isset($_SESSION['clienteLogado']) && !empty($_SESSION['clienteLogado'])) {
        unset($_SESSION['clienteLogado']);
    }
}

header('Location: ../index.php');
exit;
?>