<?php
$titulo = 'Perfil';
$css = './css/user.css';
require_once 'partials/navbar.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['admLogado'])) {
    $usuario = $_SESSION['admLogado'];
    $tipoConta = 'Administrador';
} elseif (isset($_SESSION['clienteLogado'])) {
    $usuario = $_SESSION['clienteLogado'];
    $tipoConta = 'Cliente';
} else {
    header('Location: form_login.php');
    exit;
}
?>
<body>
    <main>
        <div class="container">
            <section class="form-cadastro">
                <h1>Meu Perfil</h1>
                <p class="subtitulo">Confira as informações da conta e use o botão abaixo para sair.</p>

                <label>Tipo de conta</label>
                <div class="caixaInput">
                    <input type="text" class="inp" value="<?= htmlspecialchars($tipoConta) ?>" disabled>
                </div>

                <label>Nome</label>
                <div class="caixaInput">
                    <input type="text" class="inp" value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>" disabled>
                </div>

                <?php if (!empty($usuario['cnpj'])): ?>
                    <label>CNPJ</label>
                    <div class="caixaInput">
                        <input type="text" class="inp" value="<?= htmlspecialchars($usuario['cnpj']) ?>" disabled>
                    </div>
                <?php endif; ?>

                <?php if (!empty($usuario['email'])): ?>
                    <label>E-mail</label>
                    <div class="caixaInput">
                        <input type="text" class="inp" value="<?= htmlspecialchars($usuario['email']) ?>" disabled>
                    </div>
                <?php endif; ?>

                <?php if (!empty($usuario['id_administrador'])): ?>
                    <label>ID do administrador</label>
                    <div class="caixaInput">
                        <input type="text" class="inp" value="<?= htmlspecialchars($usuario['id_administrador']) ?>" disabled>
                    </div>
                <?php endif; ?>

                <?php if (!empty($usuario['id_cliente'])): ?>
                    <label>ID do cliente</label>
                    <div class="caixaInput">
                        <input type="text" class="inp" value="<?= htmlspecialchars($usuario['id_cliente']) ?>" disabled>
                    </div>
                <?php endif; ?>

                <a href="process/logout.php?logout=logout" class="botao_form">Sair</a>
            </section>
        </div>
    </main>
</body>
</html>