<?php

    $pagina = 'cadastro';

    $titulo = 'Byteware';
    $css = './css/cadastroPro.css';
    require_once 'crud.php';
    require_once 'partials/sidebar.php';

?>


<body>

    <main>
        <form action="insertProdutos.php" method="POST" class="formulario" enctype="multipart/form-data">
            <h1 class="degrade">Cadastro de Produto</h1>
            <input type="text" id="produto" name="nome" class="inp" placeholder="Nome do Produto" required>

            <input type="text" id="pn" name="pn" class="inp" placeholder="Part Number" required>

            <input type="number" id="preco" name="preco" class="inp" placeholder="Preço" required>

            <input type="number" id="qtd" name="estoque" class="inp" placeholder="Estoque" required>

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="cat">
                <option value="" disabled selected>Selecione uma opção...</option>
                <option value="sensores" required>Sensores</option>
                <option value="clp">CLPs</option>
                <option value="ihm">IHMs</option>
                <option value="fonte">Fontes Industriais</option>
                <option value="reles">Relés</option>
                <option value="inv_freq">Inversores de Frequência</option>
            </select>

            <!-- <input type="text" name="descricao" class="inp" placeholder ="Descrição" required> -->
            <textarea name="mensagem" rows="4" cols="50" placeholder="Insira a descrição do produto" required></textarea>

            <input type="text" id="ficha_tecnica" name="ficha_tecnica" placeholder="Ficha Técnica do Produto" required>

            <input type="file" name="imagem" class="inp" required>

            <input type="radio" idname="status"

            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </main>
</body>
</html>