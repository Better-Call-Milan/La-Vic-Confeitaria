<?php
session_start();

// Verifica se o usuário está logado corretamente
if (!isset($_SESSION['id']) || !isset($_SESSION['nome']) || !isset($_SESSION['tipo'])) {
    header('Location: entrar.php');
    exit();
}
?>