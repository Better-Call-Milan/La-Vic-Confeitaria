<?php
session_start();
include ('conexao.php');

//Evitando que o usuario acesse a pagina login.php pelo buscador sem ter digitado email e senha.
if(empty($_POST['email']) || empty($_POST['senha'])) {
	header('Location: entrar.php');
	exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT id, nome, tipo FROM usuarios WHERE email = '{$email}' AND senha = md5('{$senha}')";

//echo $query;exit;
$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);
//echo $row;exit;

//if($row == 1) {
//	$usuario_bd = mysqli_fetch_assoc($result);
//	$_SESSION['nome'] = $usuario_bd['nome'];
//	header('Location: painel_cliente.php');
//	exit();
//} else {
//	$_SESSION['nao_autenticado'] = true;
//	header('Location: entrar.php');
//	exit();
//}

if ($row == 1) {
    $usuario_bd = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $usuario_bd['id'];
    $_SESSION['nome'] = $usuario_bd['nome'];
    $_SESSION['tipo'] = $usuario_bd['tipo'];

    if (strtolower(trim($usuario_bd['tipo'])) === 'admin') {
        header('Location: painel_admin.php');
    } else {
        header('Location: painel_cliente.php');
    }
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: entrar.php');
    exit();
}