<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastroPro.css">
    <title>Cadastro Técnico</title>
</head>
<body>
    <main>
        <form action="#" method="POST" class="formulario" enctype="multipart/form-data">
            <h1 class="degrade">Cadastro de Produto</h1>
            <input type="text" id="produto" name="nome" class="inp" placeholder="Nome do Produto">
            <input type="number" id="preco" name="preco" class="inp" placeholder="Preço">
            <input type="number" id="qtd" name="qtd" class="inp" placeholder="Quantidade">
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="cat">
                <option value="" disabled selected>Selecione uma opção...</option>
                <option value="sensores">Sensores</option>
                <option value="clp">CLPs</option>
                <option value="ihm">IHMs</option>
                <option value="fonte">Fontes Industriais</option>
                <option value="reles">Relés</option>
                <option value="inv_freq">Inversores de Frequência</option>
            </select>
            <input type="text" id="pn" name="pn" class="inp" placeholder="Part Number">


            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </main>
</body>
</html>
