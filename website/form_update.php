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
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    header('Location: estoque.php?erro=errolink_invalido');
    exit;
}

$produto = read($pdo, 'produtos', "id_produto=$id");
if (!$produto) {
    header('Location: estoque.php?erro=erro_linkinvalido');
    exit;
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $dados = [
        'nome_produto' => htmlspecialchars(trim($_POST['nome'])),
        'pn'           => htmlspecialchars(trim($_POST['pn'])),
        'preco'        => htmlspecialchars(trim($_POST['preco'])),
        'estoque'      => htmlspecialchars(trim($_POST['estoque'])),
        'categoria'    => htmlspecialchars(trim($_POST['categoria'])),
        'descricao'    => htmlspecialchars(trim($_POST['descricao'])),
    ];

    // Se veio uma imagem, valide e mova antes do update único
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE) {
        $tipos_permitidos = ['image/jpeg', 'image/png', 'image/jpg'];
        $tamanho_max = 10 * 1024 * 1024;

        if (in_array($_FILES['imagem']['type'], $tipos_permitidos) && $_FILES['imagem']['size'] <= $tamanho_max) {
            $pn_tratado = preg_replace('/[^A-Za-z0-9_-]/', '', $dados['pn'] ? $dados['pn'] : $produto['pn']);
            $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
            if (!in_array($extensao, ['jpg', 'jpeg', 'png'])) {
                header('Location: form_update.php?id='.$id.'&erro=4');
                exit;
            }
            $nome_img = 'produto_'.$pn_tratado.'_'.time().'.'.$extensao;

            $dir_server = __DIR__."/imagens_produtos/";
            if (!is_dir($dir_server)) mkdir($dir_server, 0755, true);
            $arquivo_server = $dir_server.$nome_img;
            $arquivo_db = './imagens_produtos/'.$nome_img;

            if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo_server)) {
                header('Location: form_update.php?id='.$id.'&erro=3');
                exit;
            }

            // anexe o caminho da nova imagem aos dados a atualizar
            $dados['imagem'] = $arquivo_db;
        } else {
            header('Location: form_update.php?id='.$id.'&erro=4');
            exit;
        }
    }

    // Atualiza todos os campos (incluindo imagem se houve upload)
    update($pdo, 'produtos', $dados, 'id_produto='.$id);

    // Se houve upload, remova a imagem antiga para não acumular arquivos
    if (isset($dados['imagem'])) {
        $old_path = $produto['imagem'];
        if ($old_path && $old_path !== $dados['imagem']) {
            $old_server = realpath(__DIR__ . '/' . ltrim($old_path, './'));
            $imagens_dir = realpath(__DIR__ . '/imagens_produtos/');
            if ($old_server && $imagens_dir && strpos($old_server, $imagens_dir) === 0 && file_exists($old_server)) {
                @unlink($old_server);
            }
        }
    }

    header('Location: form_update.php?id='.$id.'&atualizado=1');
    exit;
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