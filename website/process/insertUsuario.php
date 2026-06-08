<?php
require_once '../crud.php';

if ($_POST['senha'] === $_POST['confirmar_senha']) {
    $novoCliente = [
        'nome' => htmlspecialchars(trim($_POST['nome'])),
        'cnpj' => htmlspecialchars(trim($_POST['cnpj'])),
        'email' => htmlspecialchars(trim($_POST['email'])),
        'senha' => htmlspecialchars(trim($_POST['senha']))
    ];

    create($pdo, 'clientes', $novoCliente);
    header('Location: ../form_login.php');
    exit;
}

header('Location: ../form_cadastro.php?erro=senha_incorreta');
exit;
?>