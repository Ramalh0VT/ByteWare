<?php
require_once 'crud.php';
$titulo = 'Editar de produtos';
$css = './css/cadastroPro.cssd';
// require_once './partials/sidebar.php';
$id = null;
$erro = null;
$msg = null;  
if(isset($_GET['erro'])){
    $msg = $_GET['erro'];
    if($msg === '3'){
        $msg = '<h1 class="msg">Algum erro desconhecido ocorreu com a sua imagem</h1>';
    }
    elseif($msg === '4'){
        $msg = '<h1 class="msg">A sua imagem tem tamanho acima de 10MB ou não é PNG ou JPG/JPEG. Tente novamente</h1>';
    }
    else{
        $msg = '<h1 class="msg">Um erro desconhecido ocorreu.</h1>';
    }
    }
    if(isset($_GET['atualizado'])){
        $msg = '<h1 class="msg">Produto atualizado com sucesso!</h1>';
    }

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else{
    header('Location: estoque.php?erro=errolink_invalido');
    die();
}

$produto = read($pdo,'produtos',"id_produto=$id");


// O UPDATE PROPRIAMENTE DITO 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
$tipos_permitidos = ['image/jpeg','image/png','image/jpg'];
$tamanho_max = 10 * 1024 * 1024;

if (isset($_FILES['imagem']) && in_array($_FILES['imagem']['type'],$tipos_permitidos) && $_FILES['imagem']['size'] <= $tamanho_max){
$extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
$nome_img = 'produto_'.$id.'.'.$extensao.'';
$dir = './';
$caminho = $dir.'uploads/';
$arquivo = $caminho.$nome_img;

if (move_uploaded_file($_FILES['imagem']['tmp_name'],$)){
    update($pdo, 'produtos', ['imagem' => $arquivo], "id_produto=$id");
}
if ($pife){
    header('Location: form_update.php?id='.$id.'&erro=3');
    die();
}

$dados = [
    'nome_produto' => htmlspecialchars(trim($_POST['nome'])),
    'pn' => htmlspecialchars(trim($_POST['pn'])),
    'preco' => htmlspecialchars(trim($_POST['preco'])),
    'estoque' => htmlspecialchars(trim($_POST['estoque'])),
    'categoria' => htmlspecialchars(trim($_POST['categoria'])),
    'descricao' => htmlspecialchars(trim($_POST['descricao'])),
];
    update($pdo,'produtos',$dados,'id_produto='.$id.'');
    header('Location: form_update.php?atualizado=1');
    die();
}
else{
    header('Location: form_update.php?id='.$id.'&erro=4');
}
}



// CORPO DO HTML 

?>
<body>
    <?php
        if(isset($msg)){
            echo $msg;
        }
    ?>
    <div class="centralizar">
        <form action="./form_update.php?id=<?=$id?>" method="post" class="form-cadastro" enctype="multipart/form-data">
            <h1 class="titulo-centralizado">Edição</h1>

            <label class="label_form">Nome</label>
            <input type="text" maxlength = "200" value="<?php echo $produto['nome_produto'];?>" name="nome" >

            <label class="label_form">PN:</label>
            <input type="text" maxlength="255" value="<?php echo $produto['pn'];?>" name="pn" >

            <label class="label_form">Preço:</label>
            <input type="number" min="0" step=".01" max="99999999999999" value="<?php echo $produto['preco'];?>" name="preco">

            <label for="categoria">Categoria</label>
            <select name="categoria" value="<?=$produto['categoria']?>" id="categoria" class="cat">
                <option value="" disabled selected>Selecione uma opção...</option>
                <option value="sensores">Sensores</option>
                <option value="clp">CLPs</option>
                <option value="ihm">IHMs</option>
                <option value="fonte">Fontes Industriais</option>
                <option value="reles">Relés</option>
                <option value="inv_freq">Inversores de Frequência</option>
            </select>

            <label class="label_form">Estoque:</label>
            <input type="number" min="0" value="<?php echo $produto['estoque']; ?>" name="estoque">

            <label class="label_form">Descrição:</label>
            <input type="text" maxlength="1000" value="<?php echo $produto['descricao'];?>" name="descricao">

    
            <label class="label_form">Imagem:</label>
            
            <input type="file" value="<?php echo $produto['imagem'];?>" name="imagem">

            <button type="submit" name="id" value="<?=$id?>" class="botao_form">Editar</button>

            <img src="" alt="i">
    </div>
    </form>
</body>
</html>