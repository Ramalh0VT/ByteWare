<?php
require_once '../crud.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (
    $_POST['categoria'] === 'sensores' ||
    $_POST['categoria'] === 'clp' ||
    $_POST['categoria'] === 'ihm' ||
    $_POST['categoria'] === 'fonte' ||
    $_POST['categoria'] === 'reles' ||
    $_POST['categoria'] === 'inv_freq'
) {
    $novoProduto = [
        'nome_produto' => htmlspecialchars(trim($_POST['nome'])),
        'pn' => htmlspecialchars(trim($_POST['pn'])),
        'preco' => htmlspecialchars(trim($_POST['preco'])),
        'estoque' => htmlspecialchars(trim($_POST['estoque'])),
        'categoria' => htmlspecialchars(trim($_POST['categoria'])),
        'descricao' => htmlspecialchars(trim($_POST['descricao'])),
        'imagem' => '',
        'status' => htmlspecialchars(trim($_POST['status'])),
        'id_administrador' => htmlspecialchars(trim($_SESSION['admLogado']['id_administrador']))
    ];

    // Valida upload
    if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] === UPLOAD_ERR_NO_FILE) {
        header('Location: ../cadastroPro.php?erro2=3');
        exit;
    }

    $tipos_permitidos = ['image/jpeg', 'image/png', 'image/jpg'];
    $tamanho_max = 10 * 1024 * 1024;

    if (!in_array($_FILES['imagem']['type'], $tipos_permitidos)) {
        header('Location: ../cadastroPro.php?erro2=1');
        exit;
    }

    if ($_FILES['imagem']['size'] > $tamanho_max) {
        header('Location: ../cadastroPro.php?erro2=2');
        exit;
    }

    // Gera nome seguro/único e move ANTES de inserir no DB
    $pn_tratado = preg_replace('/[^A-Za-z0-9_-]/', '', $novoProduto['pn']);
    $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    if (!in_array($extensao, ['jpg', 'jpeg', 'png'])) {
        header('Location: ../cadastroPro.php?erro2=1');
        exit;
    }
    $nome_img = 'produto_' . $pn_tratado . '_' . time() . '.' . $extensao;

    $diretorio_server = __DIR__ . '/../imagens_produtos/';
    if (!is_dir($diretorio_server)) mkdir($diretorio_server, 0755, true);
    $arquivo_server = $diretorio_server . $nome_img;
    $arquivo_db = './imagens_produtos/' . $nome_img; // caminho usado no front-end

    if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo_server)) {
        header('Location: ../cadastroPro.php?erro2=3');
        exit;
    }

    // Agora crie o registro com o caminho da imagem
    $novoProduto['imagem'] = $arquivo_db;
    $novo_produto_real = create($pdo, 'produtos', $novoProduto);

    // Se criação falhar, remove arquivo movido e retorna erro
    if (!$novo_produto_real) {
        if (file_exists($arquivo_server)) @unlink($arquivo_server);
        header('Location: ../cadastroPro.php?erro2=3');
        exit;
    }

    header('Location: ../cadastroPro.php?criado=1');
    exit;
}

header('Location: ../cadastroPro.php?erro=categoria');
exit;
?>