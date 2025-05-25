<?php
session_start();
include('conexao.php');

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
$data_nasc = mysqli_real_escape_string($conexao, trim($_POST['data_nasc']));
$cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
$numero_end = mysqli_real_escape_string($conexao, trim($_POST['numero_end']));
$complemento_end = mysqli_real_escape_string($conexao, trim($_POST['complemento_end']));
$bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
$cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
$estado = mysqli_real_escape_string($conexao, trim($_POST['estado']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));

//Uma query vendo se já existe um usuario com o mesmo email.
$sql = "SELECT COUNT(*) as total FROM usuarios WHERE email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] ==1){
    $_SESSION['usuario_existe'] = true;
    header('Location: cadastro.php');
    exit;
}

//Inserindo tudo no banco.
$sql = "INSERT INTO usuarios (nome, email, telefone, data_nascimento, cep, rua, numero, complemento, bairro, cidade, estado, senha, data_cadastro) VALUES ('$nome', '$email', '$telefone', '$data_nasc', '$cep', '$rua', '$numero_end', '$complemento_end', '$bairro', '$cidade', '$estado', '$senha', NOW())";

if($conexao->query($sql) === TRUE) {
    $_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: cadastro.php');
exit;
?>