<?php
require_once '../crud.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Se o session clientes ainda estiver vazio e o post email-login também, significa que
// que o usuário não acessou o formulário de login corretamente.
if (!isset($_SESSION['clienteLogado']) && !isset($_SESSION['admLogado']) && !isset($_POST['email-login'])) {
    header('Location: ../form_login.php?erro=restrito');
    exit;
}

if (isset($_POST['email-login'])) {
    require_once 'validacaologin.php';
    exit;
}
?>