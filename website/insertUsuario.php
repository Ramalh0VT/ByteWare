<?php
require_once 'crud.php';


if($_POST['senha'] == $_POST['confirmar_senha']) {
    $novoCliente = [
    'nome' => $_POST['nome'],
    'cnpj' => $_POST['cnpj'],
    'email' => $_POST['email'],
    'senha' => $_POST['senha']
    ];

    $idNovoCliente = create($pdo, 'clientes', $novoCliente);
    header('Location: form_login.php');
    exit;

} else {
    
    header('Location: form_cadastro.php?erro=senha_incorreta');
    exit;
}


