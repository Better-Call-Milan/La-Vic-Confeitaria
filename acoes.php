<?php
session_start();
require 'conexao.php';

if (isset($_POST['create_usuario'])) {
    $tipo = mysqli_real_escape_string($conexao, trim($_POST['tipo']));
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

//Inserindo tudo no banco.
$sql = "INSERT INTO usuarios (tipo, nome, email, telefone, data_nascimento, cep, rua, numero, complemento, bairro, cidade, estado, senha, data_cadastro) VALUES ('$tipo', '$nome', '$email', '$telefone', '$data_nasc', '$cep', '$rua', '$numero_end', '$complemento_end', '$bairro', '$cidade', '$estado', '$senha', NOW())";

mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0 ) {
        $_SESSION['mensagem'] = 'Usuário criado com sucesso!';
        header('Location: usuarios.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi criado.';
        header('Location: usuarios.php');
        exit;
    }
}

if (isset($_POST['update_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);

    $tipo = mysqli_real_escape_string($conexao, trim($_POST['tipo']));
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
    $senha = trim($_POST['senha']);

//Inserindo tudo no banco.
$sql = "UPDATE usuarios SET tipo = '$tipo', nome = '$nome', email = '$email', telefone = '$telefone', data_nascimento = '$data_nasc', cep = '$cep', rua = '$rua', numero = '$numero_end', complemento = '$complemento_end', bairro = '$bairro', cidade = '$cidade', estado = '$estado', senha = '$senha'";
if (!empty($senha)) {
		$sql .= ", senha='" . password_hash($senha, PASSWORD_DEFAULT) . "'";
	}
	$sql .= " WHERE id = '$usuario_id'";
	mysqli_query($conexao, $sql);
	if (mysqli_affected_rows($conexao) > 0) {
		$_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
		header('Location: usuarios.php');
		exit;
	} else {
		$_SESSION['mensagem'] = 'Usuário não foi atualizado';
		header('Location: usuarios.php');
		exit;
	}
}




if (isset($_POST['create_pedido'])) {
    $id_usuario = $_SESSION['id']; // ou outro identificador do cliente
    $produtos = $_POST['id_produto'];
    $quantidades = $_POST['quantidade'];

    // Criar pedido
    $queryPedido = "INSERT INTO pedidos (id_usuario, data_criacao) VALUES ($id_usuario, NOW())";
    if (mysqli_query($conexao, $queryPedido)) {
        $id_pedido = mysqli_insert_id($conexao);

        foreach ($produtos as $i => $id_produto) {
            $quantidade = $quantidades[$i];
            $queryItem = "INSERT INTO itens_pedido (id_pedido, id_produto, quantidade) 
                          VALUES ($id_pedido, $id_produto, $quantidade)";
            mysqli_query($conexao, $queryItem);
        }

        header("Location: painel_cliente.php?msg=Pedido criado com sucesso");
        exit();
    } else {
        echo "Erro ao criar pedido.";
    }
}


if (isset($_POST['update_meus_dados'])) {
    $usuario_id = $_SESSION['id']; // cliente logado

    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
    $rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
    $numero_end = mysqli_real_escape_string($conexao, trim($_POST['numero_end']));
    $complemento_end = mysqli_real_escape_string($conexao, trim($_POST['complemento_end']));
    $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $estado = mysqli_real_escape_string($conexao, trim($_POST['estado']));
    $senha = trim($_POST['senha']);

    // Atualiza dados (senha só se o campo não estiver vazio)
    $sql = "UPDATE usuarios SET 
                nome = '$nome',
                email = '$email',
                telefone = '$telefone',
                cep = '$cep',
                rua = '$rua',
                numero = '$numero_end',
                complemento = '$complemento_end',
                bairro = '$bairro',
                cidade = '$cidade',
                estado = '$estado'";

    if (!empty($senha)) {
        $sql .= ", senha='" . md5($senha) . "'";
    }

    $sql .= " WHERE id = '$usuario_id'";

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Seus dados foram atualizados com sucesso!';
        header('Location: painel_cliente.php?msg=atualizado');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Nenhuma alteração foi feita.';
        header('Location: painel_cliente.php?msg=sem_alteracao');
        exit;
    }
}

?>