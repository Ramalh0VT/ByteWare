<?php
require_once 'crud.php';
require_once 'init.php';
session_start();
// <!-- Verificação do post['categoria'] Vai verificar se recebeu algo ou não-->
if($_POST['categoria'] == 'sensores' || $_POST['categoria'] == 'clp' ||  $_POST['categoria'] == 'ihm' || $_POST['categoria'] == 'fonte' || $_POST['categoria'] == 'reles' || $_POST['categoria'] ==  'inv_freq'){
//try{
    $novoProduto = [
    'nome_produto' => htmlspecialchars(trim($_POST['nome'])),
    'pn' => htmlspecialchars(trim($_POST['pn'])),
    'preco' => htmlspecialchars(trim($_POST['preco'])),
    'estoque' => htmlspecialchars(trim($_POST['estoque'])),
    'categoria' => htmlspecialchars(trim($_POST['categoria'])),
    'descricao' => htmlspecialchars(trim($_POST['descricao'])),
    'imagem' => htmlspecialchars(trim('')),
    'status' => htmlspecialchars(trim($_POST['status'])),
    'id_administrador' => htmlspecialchars(trim($_SESSION['admLogado']['id_administrador']))
    ];

$tipos_permitidos = ['image/jpeg','image/png','image/jpg'];
if(!in_array($_FILES['imagem']['type'],$tipos_permitidos)){
    header('Location: cadastroPro.php?erro2=1');
    die();
}
$tamanho_max = 10 * 1024 * 1024;
if ($_FILES['imagem']['size'] > $tamanho_max){
    header('Location: cadastroPro.php?erro2=2');
    die();
}
$novo_produto_real = create($pdo, 'produtos', $novoProduto); 
$pn_tratado = trim($novoProduto['pn'], '-');
$extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
$nome_img = 'produto_'.$pn_tratado.'.'.$extensao.'';
$dir = './';
$caminho = $dir.'imagens_produtos/';
$arquivo = $caminho.$nome_img;
if(move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo)){
    update($pdo, 'produtos', ['imagem' => $arquivo], "id_produto=$novo_produto_real");
    header('Location:cadastroPro.php?criado=1');
    die();
}
else{
    header('Location:cadastroPro.php?erro=3');
}
}
/*catch(Exception $e){
        header('Location:cadastroPro.php?erro2=desconhecido');
        die();
}  */

//}
else{
    // Se o admin não selecionar a categoria ele vai ser chutado para o formulário de cadastro de produto novamente
    header('Location:cadastroPro.php?erro=categoria');
}
?>