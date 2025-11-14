<?php
// Conexão e autenticação
include_once('conexao.php');
include_once('verifica_login.php');

// Verifica se a conexão existe
if (!isset($conexao) || !$conexao) {
  die("<h5 style='color:red; text-align:center; margin-top:30px;'>Erro: conexão com o banco de dados não estabelecida.</h5>");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Visualizar Pedido - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
    <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="assets/img/logo.png" alt="Confeitaria La Vic" height="70">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="contato-user.html">Contato</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
            </ul>
        </div>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-5">Visualizando Pedido</h2>
        <div class="text-center mb-4">
        <p class="text-muted">Confira todos os detalhes do pedido selecionado, incluindo o cliente e os itens comprados.</p>
        </div>

        <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detalhes do Pedido</h4>
                <a href="pedidos.php" class="btn btn-danger">Voltar</a>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['id'])) {
                $pedido_id = mysqli_real_escape_string($conexao, $_GET['id']);

                // Consulta o pedido + dados do usuário
                $sql = "SELECT 
                            p.*, 
                            u.nome AS nome_usuario, u.email, u.telefone, 
                            u.rua, u.numero, u.complemento, u.bairro, u.cidade, u.estado, u.cep
                        FROM pedidos p
                        LEFT JOIN usuarios u ON p.id_usuario = u.id
                        WHERE p.id = '$pedido_id'";
                $query = mysqli_query($conexao, $sql);

                if ($query && mysqli_num_rows($query) > 0) {
                    $pedido = mysqli_fetch_array($query);

                    // Monta endereço condicional
                    $enderecoCompleto = '-';
                    if (strtolower($pedido['entrega']) === 'entrega') {
                    $partes = [];
                    if (!empty($pedido['rua'])) $partes[] = $pedido['rua'];
                    if (!empty($pedido['numero'])) $partes[] = 'Nº ' . $pedido['numero'];
                    if (!empty($pedido['complemento'])) $partes[] = $pedido['complemento'];
                    if (!empty($pedido['bairro'])) $partes[] = $pedido['bairro'];
                    if (!empty($pedido['cidade'])) $partes[] = $pedido['cidade'];
                    if (!empty($pedido['estado'])) $partes[] = $pedido['estado'];
                    if (!empty($pedido['cep'])) $partes[] = 'CEP: ' . $pedido['cep'];
                    $enderecoCompleto = implode(', ', $partes);
                    }
                ?>

                <!-- 🔹 Resumo do Pedido -->
                <div class="alert alert-light border shadow-sm mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1 fw-bold">Pedido #<?= $pedido['id']; ?></h5>
                        <p class="mb-0 text-muted">
                        Cliente: <strong><?= htmlspecialchars($pedido['nome_usuario'] ?? 'Cliente removido'); ?></strong><br>
                        Realizado em: <?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?>
                        </p>
                    </div>
                    <div class="text-end mt-2 mt-md-0">
                        <span class="badge bg-primary fs-6 px-3 py-2"><?= htmlspecialchars($pedido['status']); ?></span><br>
                        <h4 class="mt-2 mb-0 text-success">Total: R$ <?= number_format($pedido['total'], 2, ',', '.'); ?></h4>
                    </div>
                    </div>
                </div>

                <!-- 🔸 Informações Gerais -->
                <div class="row mb-4">
                    <div class="col-md-4">
                    <label class="form-label fw-bold">Forma de Pagamento</label>
                    <p class="form-control"><?= htmlspecialchars($pedido['forma_pagamento']); ?></p>
                    </div>
                    <div class="col-md-4">
                    <label class="form-label fw-bold">Tipo de Entrega</label>
                    <p class="form-control"><?= htmlspecialchars($pedido['entrega']); ?></p>
                    </div>
                    <div class="col-md-4">
                    <label class="form-label fw-bold">Contato</label>
                    <p class="form-control" style="height:auto;">
                        Email: <?= htmlspecialchars($pedido['email']); ?><br>
                        Telefone: <?= htmlspecialchars($pedido['telefone']); ?>
                    </p>
                    </div>
                </div>

                <!-- 🔸 Endereço -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Endereço de Entrega</label>
                    <p class="form-control" style="height:auto; min-height:60px;">
                    <?= htmlspecialchars($enderecoCompleto); ?>
                    </p>
                </div>

                <hr>

                <!-- 🔸 Itens do Pedido -->
                <h5 class="mt-4 mb-3">Itens do Pedido</h5>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_itens = "SELECT 
                                        pi.*, 
                                        pr.nome AS nome_produto, 
                                        pr.preco AS preco_produto
                                    FROM pedido_itens pi
                                    LEFT JOIN produtos pr ON pi.id_produto = pr.id
                                    WHERE pi.id_pedido = '$pedido_id'";
                        $itens = mysqli_query($conexao, $sql_itens);

                        if ($itens && mysqli_num_rows($itens) > 0) {
                        $contador = 1;
                        while ($item = mysqli_fetch_array($itens)) {
                            $subtotal = $item['quantidade'] * $item['preco_produto'];
                            ?>
                            <tr>
                            <td><?= $contador++; ?></td>
                            <td><?= htmlspecialchars($item['nome_produto']); ?></td>
                            <td>R$ <?= number_format($item['preco_produto'], 2, ',', '.'); ?></td>
                            <td><?= $item['quantidade']; ?></td>
                            <td>R$ <?= number_format($subtotal, 2, ',', '.'); ?></td>
                            </tr>
                            <?php
                        }
                        } else {
                        echo '<tr><td colspan="5" class="text-center text-muted">Nenhum item encontrado para este pedido.</td></tr>';
                        }
                        ?>
                    </tbody>
                    </table>
                </div>

                <?php
                } else {
                    echo "<h5>Pedido não encontrado.</h5>";
                }
                } else {
                echo "<h5>ID do pedido não informado.</h5>";
                }
                ?>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-4 custom-footer">
        <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>