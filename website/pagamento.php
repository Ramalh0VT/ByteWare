<?php
session_start();
$titulo = 'Carrinho de Compras';
$css = './css/pagamento.css';
require_once 'crud.php';
require_once 'partials/navbar.php';


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $forma_pagamento = $_POST['forma_pagamento'] ?? '';
    $numero_cartao = $_POST['numero_cartao'] ?? '';
    $data_validade = $_POST['data_validade'] ?? '';
    $cvv = $_POST['cvv'] ?? '';
    $nome_titular = $_POST['nome_titular'] ?? '';


    $erro = '';
    
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido';
    } elseif(empty($forma_pagamento)) {
        $erro = 'Selecione uma forma de pagamento';
    } elseif(empty($numero_cartao) || strlen($numero_cartao) < 13) {
        $erro = 'Número do cartão inválido';
    } elseif(empty($data_validade) || !preg_match('/^\d{2}\/\d{2}$/', $data_validade)) {
        $erro = 'Data de validade inválida (use MM/AA)';
    } elseif(empty($cvv) || strlen($cvv) < 3) {
        $erro = 'CVV inválido';
    } elseif(empty($nome_titular)) {
        $erro = 'Nome do titular é obrigatório';
    }

    if(empty($erro)) {

        $dados_pagamento = [
            'email' => $email,
            'forma_pagamento' => $forma_pagamento,
            'numero_cartao' => $numero_cartao,
            'data_validade' => $data_validade,
            'cvv' => $cvv,
            'nome_titular' => $nome_titular,
            'data_pagamento' => date('Y-m-d H:i:s')
        ];


        $id_pagamento = create($pdo, 'pagamentos', $dados_pagamento);


        unset($_SESSION['produtos']);


        header('Location: index.php?sucesso=pagamento_realizado');
        exit;
    }
}

?>

    <body>

<section class="formcard">
    <?php if(isset($_GET['sucesso']) && $_GET['sucesso'] == 'pagamento_realizado'): ?>
        <div style="background-color: #4CAF50; color: white; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
            Pagamento realizado com sucesso!
        </div>
    <?php endif; ?>

    <?php if(!empty($erro)): ?>
        <div style="background-color: #f44336; color: white; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
            <?php echo $erro; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="pagamento.php">
        <h4>E-mail de usuário: </h4>
        <label class="que">
            <input type="email" name="email" placeholder="seu@email.com" value="<?php echo $_POST['email'] ?? ''; ?>" required>
        </label>

        <h4>Escolha a forma de pagamento: </h4>
        <label class="radio-text">
            <input type="radio" name="forma_pagamento" value="Debito" <?php echo ($_POST['forma_pagamento'] ?? '') === 'Debito' ? 'checked' : ''; ?>>
            Débito
        </label>

        <label class="radio-text">
            <input type="radio" name="forma_pagamento" value="Credito" <?php echo ($_POST['forma_pagamento'] ?? '') === 'Credito' ? 'checked' : ''; ?>>
            Crédito
        </label>

        <label class="radio-text">
            <input type="radio" name="forma_pagamento" value="Pix" <?php echo ($_POST['forma_pagamento'] ?? '') === 'Pix' ? 'checked' : ''; ?>>
            Pix
        </label>

        <label class="radio-text">
            <input type="radio" name="forma_pagamento" value="Boleto" <?php echo ($_POST['forma_pagamento'] ?? '') === 'Boleto' ? 'checked' : ''; ?>>
            Boleto
        </label>

        <h4>Número do cartão: </h4>
        <label class="que">
            <input type="text" name="numero_cartao" placeholder="1234 1234 1234 1234" value="<?php echo $_POST['numero_cartao'] ?? ''; ?>">
        </label>

        <h4>Data de validade: </h4>
        <label class="que"> 
            <input type="text" name="data_validade" placeholder="MM/AA" value="<?php echo $_POST['data_validade'] ?? ''; ?>">
        </label>

        <h4>CVV: </h4>
        <label class="que">
            <input type="text" name="cvv" placeholder="000" value="<?php echo $_POST['cvv'] ?? ''; ?>">
        </label>

        <h4>Nome do Titular do cartão: </h4>
        <label class="que">
            <input type="text" name="nome_titular" placeholder="Nome completo" value="<?php echo $_POST['nome_titular'] ?? ''; ?>">
        </label>

        <button type="submit">Pagar</button>
    </form>
</section>

    </body>
</html>