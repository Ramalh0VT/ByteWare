<?php
    $pagina = 'cadastro';
    $titulo = 'Byteware';
    $css = './css/cadastroPro.css';
    require_once 'crud.php';
    require_once 'partials/sidebar.php';
    $erro = null;
    $msg = null;  
    if(isset($_GET['erro2'])){
        $msg = $_GET['erro2'] ?? null;
        if($msg === '1'){
            $msg = '<h1 class="msg">Formato de arquivo não permítido! Os formatos permitidos são png e jpg/jpeg Erro:'.$_GET['erro2'].'</h1>';
        }
        elseif($msg === '2'){
            $msg = '<h1 class="msg">Tamanho de arquivo muito grande!O tamanho máximo é 10MB Erro: '.$_GET['erro2'].'</h1>';
        }
        elseif($msg === '3'){
            $msg = '<h1 class="msg">Algum erro ocorreu com a sua imagem Erro: '.$_GET['erro2'].'</h1>';
        }
        else{
            $msg = '<h1 class="msg">Um erro desconhecido ocorreu.</h1>';
        }
        }
        if(isset($_GET['criado'])){
            $msg = '<h1 class="msg">Produto criado com sucesso!</h1>';
        }
      
?>
<body>
<?php
    if(isset($msg)){
        print $msg;
    }
?>
    <main>

        <form action="insertProdutos.php" method="POST" class="formulario" enctype="multipart/form-data">
            <h1 class="degrade">Cadastro de Produto</h1>
            <input type="text" id="produto" name="nome" maxlength="200" class="inp" placeholder="Nome do Produto" required>

            <input type="text" id="pn" name="pn" class="inp" maxlength="255" placeholder="Part Number" required>

            <input type="number" id="preco" name="preco" class="inp" min="0.01" max="99999999999999" step=".01"  placeholder="Preço" required>

            <input type="number" id="estoque" name="estoque" class="inp" min="0" placeholder="Estoque" required>

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="cat" required>
                <option value="" disabled selected>Selecione uma opção...</option>
                <option value="sensores">Sensores</option>
                <option value="clp">CLPs</option>
                <option value="ihm">IHMs</option>
                <option value="fonte">Fontes Industriais</option>
                <option value="reles">Relés</option>
                <option value="inv_freq">Inversores de Frequência</option>
            </select>
            <?php
            if($erro == 'categoria'){
                echo '<p>Selecione uma categoria válida!</p>';
            }
            ?>
            <!-- <input type="text" name="descricao" class="inp" placeholder ="Descrição" required>--> 
            <textarea class="textarea" name="descricao" rows="4" cols="50" maxlength="1000"  placeholder="Insira a descrição do produto" required></textarea>

            <label for="imagem" class="imagem">Upload</label>
            <input type="file" id="imagem" name="imagem" class="inp" required>

            <div class="rad">
                <label for="ativo">Ativo</label>
                <input type="radio" id="status" name="status" value="1" required>
            </div>
            
            <div class="rad">
                <label for="inativo">Inativo</label>
                <input type="radio" id="status" name="status" value="0" required>
            </div>
            
            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </main>
</body>
</html>
