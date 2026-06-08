<?php
require_once 'crud.php';
$titulo = 'Editar de produtos';
$css = './css/form_update.css';
require_once './partials/sidebar.php';

$id = null;
$msg = null;  

if(isset($_GET['erro'])){
    $msg_erro = $_GET['erro'];
    if($msg_erro === '3'){
        $msg = '<h1 class="msg">Algum erro desconhecido ocorreu com a sua imagem</h1>';
    }
    elseif($msg_erro === '4'){
        $msg = '<h1 class="msg">A sua imagem tem tamanho acima de 10MB ou não é PNG ou JPG/JPEG. Tente novamente</h1>';
    }
    else{
        $msg = '<h1 class="msg">Um erro desconhecido ocorreu.</h1>';
    }
}

if(isset($_GET['atualizado'])){
    $msg = '<h1 class="msg">Produto atualizado com sucesso!</h1>';
    header("Location: estoque.php");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    header('Location: estoque.php?erro=errolink_invalido');
    die();
}

$produto = read($pdo, 'produtos', "id_produto=$id");


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE) {
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/jpg'];
        $tamanho_max = 10 * 1024 * 1024; 

        if (in_array($_FILES['imagem']['type'], $tipos_permitidos) && $_FILES['imagem']['size'] <= $tamanho_max){
            $pn_tratado = trim($produto['pn'], '-');
            $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $nome_img = 'produto_'.$pn_tratado.'.'.$extensao;
            $dir = './';
            $caminho = $dir.'imagens_produtos/';
            $arquivo = $caminho.$nome_img;
            
            if(move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo)){
                update($pdo, 'produtos', ['imagem' => $arquivo], 'id_produto='.$produto['id_produto']);
            } else {
                header('Location: form_update.php?id='.$id.'&erro=3');
                die();
            }
        } else {
            header('Location: form_update.php?id='.$id.'&erro=4');
            die(); 
        }
    }

   
    $dados = [
        'nome_produto' => htmlspecialchars(trim($_POST['nome'])),
        'pn'           => htmlspecialchars(trim($_POST['pn'])),
        'preco'        => htmlspecialchars(trim($_POST['preco'])),
        'estoque'      => htmlspecialchars(trim($_POST['estoque'])),
        'categoria'    => htmlspecialchars(trim($_POST['categoria'])),
        'descricao'    => htmlspecialchars(trim($_POST['descricao'])),
    ];
    
    update($pdo, 'produtos', $dados, 'id_produto='.$id);
    header('Location: form_update.php?id='.$id.'&atualizado=1');
    die();
}
?>

<body>
    <?php if(isset($msg)) { echo $msg; } ?>
    
   
    <div class="centralizar">
        <form action="./form_update.php?id=<?=$id?>" method="post" class="form-cadastro" enctype="multipart/form-data">
            <h1 class="titulo-centralizado">Edição</h1>

            <label class="label_form">Nome:</label>
            <input type="text" maxlength="200" value="<?php echo $produto['nome_produto'];?>" name="nome" >

            <label class="label_form">PN:</label>
            <input type="text" maxlength="255" value="<?php echo $produto['pn'];?>" name="pn" >

            <label class="label_form">Preço:</label>
            <input type="number" min="0" step=".01" max="99999999999999" value="<?php echo $produto['preco'];?>" name="preco">

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="cat">
                <option value="" disabled>Selecione uma opção...</option>
                <option value="sensores" <?= ($produto['categoria'] == 'sensores') ? 'selected' : '' ?>>Sensores</option>
                <option value="clp" <?= ($produto['categoria'] == 'clp') ? 'selected' : '' ?>>CLPs</option>
                <option value="ihm" <?= ($produto['categoria'] == 'ihm') ? 'selected' : '' ?>>IHMs</option>
                <option value="fonte" <?= ($produto['categoria'] == 'fonte') ? 'selected' : '' ?>>Fontes Industriais</option>
                <option value="reles" <?= ($produto['categoria'] == 'reles') ? 'selected' : '' ?>>Relés</option>
                <option value="inv_freq" <?= ($produto['categoria'] == 'inv_freq') ? 'selected' : '' ?>>Inversores de Frequência</option>
            </select>

            <label class="label_form">Estoque:</label>
            <input type="number" min="0" value="<?php echo $produto['estoque']; ?>" name="estoque">

            <label class="label_form">Descrição:</label>
            <input type="text" maxlength="1000" value="<?php echo $produto['descricao'];?>" name="descricao">
    
            <label class="label_form">Imagem Atual:</label>
            <div>
                <img src="<?php echo $produto['imagem'];?>" width="100" alt="Produto" >
            </div>
            
            <input type="file" name="imagem">

            <button type="submit" class="botao_form">Editar</button>
            <a href="estoque.php" style="margin-top: 10px; display: block; text-align: center;">Voltar ao estoque</a>
        </form>
    </div>

</body>
</html>