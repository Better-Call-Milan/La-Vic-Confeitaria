<?php
session_start();
require 'conexao.php';

//CRUD DE USUARIOS
//Criar Usuario
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

//Atualizar Usuario (Admin)
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

//Atualizar Usuario (Pessoal)
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


//CRUD DE PRODUTOS
//Criar Produto
// Criar produto
if (isset($_POST['create_produto'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $preco = $_POST['preco'];

    // Upload da imagem
    $imagem_nome = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem_nome = 'uploads/' . basename($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_nome);
    }

    $sql = "INSERT INTO produtos (nome, categoria, descricao, preco, imagem) VALUES ('$nome', '$categoria', '$descricao', '$preco', '$imagem_nome')";
    if (mysqli_query($conexao, $sql)) {
        header('Location: produtos.php?msg=Produto criado com sucesso!');
        exit;
    } else {
        echo "Erro ao criar produto: " . mysqli_error($conexao);
    }
}

//Atualizar Produto
if (isset($_POST['update_produto'])) {
    $id = mysqli_real_escape_string($conexao, $_POST['produto_id']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $preco = mysqli_real_escape_string($conexao, $_POST['preco']);

    // Upload de imagem (opcional)
    $imagem = $_FILES['imagem']['name'];
    if (!empty($imagem)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($imagem);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file);
        $update_image_sql = ", imagem='$imagem'";
    } else {
        $update_image_sql = "";
    }

    $sql = "UPDATE produtos SET 
            nome='$nome', categoria='$categoria', descricao='$descricao', preco='$preco'
            $update_image_sql
            WHERE id='$id'";
    
    $query = mysqli_query($conexao, $sql);

    if ($query) {
        header("Location: produtos.php?msg=Produto atualizado com sucesso");
        exit();
    } else {
        echo "Erro ao atualizar produto.";
    }
}


//CRUD DE PEDIDOS
//Criar Pedidos (Admin)
if (isset($_POST['create_pedido'])) {
    // Iniciar transação
    mysqli_begin_transaction($conexao);

    try {
        // Dados principais do pedido
        $id_usuario = mysqli_real_escape_string($conexao, $_POST['id_usuario']);
        $forma_pagamento = mysqli_real_escape_string($conexao, $_POST['forma_pagamento']);
        $entrega = mysqli_real_escape_string($conexao, $_POST['entrega']);
        $data_pedido = date('Y-m-d H:i:s');

        // Cálculo do total com base no banco
        $total = 0;
        $itens = $_POST['produtos'] ?? [];

        foreach ($itens as $item) {
            $id_produto = (int)$item['id'];
            $quantidade = (int)$item['quantidade'];

            if ($id_produto > 0 && $quantidade > 0) {
                $q_prod = mysqli_query($conexao, "SELECT preco FROM produtos WHERE id = $id_produto LIMIT 1");
                if ($q_prod && mysqli_num_rows($q_prod) > 0) {
                    $preco = (float)mysqli_fetch_assoc($q_prod)['preco'];
                    $total += $preco * $quantidade;
                }
            }
        }

        // Inserir pedido principal
        $sql_pedido = "INSERT INTO pedidos (id_usuario, status, forma_pagamento, entrega, data_pedido, total)
                       VALUES ('$id_usuario', 'Pendente', '$forma_pagamento', '$entrega', '$data_pedido', '$total')";
        mysqli_query($conexao, $sql_pedido);

        // Obter o ID do pedido recém-criado
        $pedido_id = mysqli_insert_id($conexao);

        // Inserir os itens do pedido
        foreach ($itens as $item) {
            $id_produto = (int)$item['id'];
            $quantidade = (int)$item['quantidade'];

            if ($id_produto > 0 && $quantidade > 0) {
                $q_prod = mysqli_query($conexao, "SELECT preco FROM produtos WHERE id = $id_produto LIMIT 1");
                $dados_prod = mysqli_fetch_assoc($q_prod);
                $preco = (float)$dados_prod['preco'];
                $subtotal = $preco * $quantidade;

                $sql_item = "INSERT INTO pedido_itens (id_pedido, id_produto, quantidade, preco_unitario, subtotal)
                             VALUES ('$pedido_id', '$id_produto', '$quantidade', '$preco', '$subtotal')";
                mysqli_query($conexao, $sql_item);
            }
        }

        // Confirmar transação
        mysqli_commit($conexao);

        $_SESSION['msg'] = "✅ Pedido criado com sucesso!";
        // Redirecionamento condicional:
        if ($_SESSION['tipo'] === 'admin') {
            header("Location: pedidos.php"); // Admin continua indo para a área administrativa
        } else {
            header("Location: pedidos-user.php"); // Usuário comum vai para o painel dele
        }
        exit;

    } catch (Exception $e) {
        // Reverter se der erro
        mysqli_rollback($conexao);
        $_SESSION['msg'] = "❌ Erro ao criar o pedido: " . $e->getMessage();
        header("Location: pedidos-create.php");
        exit;
    }
}

//Atualizar Pedidos (Admin)
if (isset($_POST['update_pedido'])) {
    $pedido_id = mysqli_real_escape_string($conexao, $_POST['pedido_id']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);
    $forma_pagamento = mysqli_real_escape_string($conexao, $_POST['forma_pagamento']);
    $entrega = mysqli_real_escape_string($conexao, $_POST['entrega']);

    $query = "UPDATE pedidos 
              SET status='$status', forma_pagamento='$forma_pagamento', entrega='$entrega'
              WHERE id='$pedido_id'";
    $query_run = mysqli_query($conexao, $query);

    if ($query_run) {
        header("Location: pedidos.php?msg=Pedido atualizado com sucesso");
        exit;
    } else {
        echo "Erro ao atualizar o pedido: " . mysqli_error($conexao);
    }
}

?>