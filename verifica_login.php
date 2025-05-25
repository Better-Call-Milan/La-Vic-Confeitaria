<?php
session_start();
//Se a sessão do usuario NÃO existir ele volta pro login
if(!$_SESSION['nome']) {
	header('Location: entrar.php');
	exit();
}