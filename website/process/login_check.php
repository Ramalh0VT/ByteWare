<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['admLogado'])) {
    $login = 'adm';
} elseif (isset($_SESSION['clienteLogado'])) {
    $login = 'cliente';
}
?>