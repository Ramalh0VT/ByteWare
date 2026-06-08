<?php
require_once '../crud.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$clientes = readAll($pdo, 'clientes');
$administradores = readAll($pdo, 'administradores');

$verificarUsuario = [
    'email' => htmlspecialchars(trim($_POST['email-login'])),
    'senha' => htmlspecialchars(trim($_POST['senha-login']))
];

session_unset();

foreach ($administradores as $mostrarAdm) {
    if ($mostrarAdm['email'] === $verificarUsuario['email'] && $mostrarAdm['senha'] === $verificarUsuario['senha']) {
        $_SESSION['admLogado'] = $mostrarAdm;
        header('Location: ../estoque.php');
        exit;
    }
}

foreach ($clientes as $mostrarCliente) {
    if ($mostrarCliente['email'] === $verificarUsuario['email'] && $mostrarCliente['senha'] === $verificarUsuario['senha']) {
        $_SESSION['clienteLogado'] = $mostrarCliente;
        header('Location: ../index.php');
        exit;
    }
}

header('Location: ../form_login.php?erro=erro_login');
exit;
?>