<?php
session_start();
if(isset($_GET['logout'])){
    if($_GET['logout'] === 'logout'){
        if(isset($_SESSION['admLogado']) && !empty($_SESSION['admLogado'])){
            unset($_SESSION['admLogado']);
            header("Location: index.php");
            exit();
        }
        elseif(isset($_SESSION['clienteLogado']) && !empty($_SESSION['clienteLogado'])){
            unset($_SESSION['clienteLogado']);
            header("Location: index.php");
            exit();
        }
    }
}
?>