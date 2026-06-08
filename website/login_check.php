<?php

if(isset($_SESSION['admLogado'])){
    $login = 'adm';
}
elseif(isset($_SESSION['clienteLogado'])){
    $login = 'cliente';
}
?>