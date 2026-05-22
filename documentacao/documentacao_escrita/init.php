<?php
require_once 'crud.php';
session_start();
?>



<?php
// Se o session clientes ainda estiver vazio e o post email-login também, significa que a pessoa não clicou no botão de login no form e ainda não foi criado o session
if (!isset($_SESSION['clienteLogado']) && !isset($_POST['email-login'])) {
    header('Location: form_login.php?erro=restrito');
    exit;
}

// Se passou pela verificação de cima, aqui agora vai verificar se a pessoa clicou no botão de login e o post email está com algo, se estiver vai rodar o validacaologin.php
if (isset($_POST['email-login'])) {
    require_once 'validacaologin.php';
    exit;
}
?>
