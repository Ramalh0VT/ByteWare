<?php
require_once 'init.php';
$clientes = readAll($pdo, 'clientes');
$administradores = readAll($pdo, 'administradores');

// Aqui vai pegar os dados do formulário de login
    $verificarUsuario = [
    'email' => htmlspecialchars(trim($_POST['email-login'])),
    'senha' => htmlspecialchars(trim($_POST['senha-login']))
    ];

session_unset();

// Aqui vai ser a verificação se é adm ou não
foreach($administradores as $mostrarAdm){
        if($mostrarAdm['email'] === $verificarUsuario['email'] && $mostrarAdm['senha'] === $verificarUsuario['senha']){
            $_SESSION['admLogado'] = [];
            $_SESSION['admLogado'] = $mostrarAdm;
            header('Location: estoque.php');
            exit;
        }
}

// Aqui vai verificar todo o banco de dados e procurar se tem alguém com o mesmo email e senha que acabou de ser digitado no form
    foreach($clientes as $mostrarCliente){
        if($mostrarCliente['email'] == $verificarUsuario['email'] && $mostrarCliente['senha'] == $verificarUsuario['senha']){
            // Agora que achou tem que abrir o session
            $_SESSION['clienteLogado'] = [];
            $_SESSION['clienteLogado'] =  $mostrarCliente;
            header('Location: index.php');
            exit;
        }
    }

// Se ele chegar nessa parte é por que o foreach rodou inteiro e não achou a pessoa certa
header('Location: form_login.php?erro=erro_login');
?>