<?php
require('conexao.php');
include('verifica_login.php');

// Verifica se o botão "Excluir" foi clicado
if (isset($_POST['delete_pedido'])) {
    $id_pedido = intval($_POST['delete_pedido']);

    // Exclui o pedido (os itens são deletados automaticamente via ON DELETE CASCADE)
    $delete_query = "DELETE FROM pedidos WHERE id = $id_pedido";
    if (mysqli_query($conexao, $delete_query)) {
        $_SESSION['mensagem'] = "Pedido excluído com sucesso!";
        $_SESSION['tipo_mensagem'] = "success";
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir o pedido.";
        $_SESSION['tipo_mensagem'] = "danger";
    }

    header("Location: pedidos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Gerenciar Pedidos - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Header / Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
      <!-- Logo -->
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

  <div class="container mt-5">
    <h2 class="text-center mb-5">Gerenciar Pedidos</h2>
    <div class="mt-5 text-center">
      <p class="text-muted">Visualize, edite ou exclua pedidos realizados pelos clientes.</p>
    </div>

    <div class="container mt-4 custom-work-container">
      <?php include('mensagem.php'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Lista de Pedidos
                <a href="painel_admin.php" class="btn btn-danger float-end">Voltar</a>
                <a href="pedido-create.php" class="btn btn-primary float-end me-2">Adicionar Pedido</a>
              </h4>
            </div>

            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                  <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Pagamento</th>
                    <th>Entrega</th>
                    <th>Endereço</th>
                    <th>Total (R$)</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT 
                                p.*, 
                                u.nome AS nome_usuario,
                                u.rua, u.numero, u.complemento, u.bairro, u.cidade, u.estado, u.cep
                                FROM pedidos p 
                                LEFT JOIN usuarios u ON p.id_usuario = u.id 
                                ORDER BY p.id DESC";
                        $pedidos = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($pedidos) > 0) {
                        foreach ($pedidos as $pedido) {

                            // Monta o endereço completo do usuário
                            $enderecoCompleto = '';
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
                            } else {
                            $enderecoCompleto = '-';
                            }
                    ?>
                    <tr>
                        <td><?= $pedido['id'] ?></td>
                        <td><?= htmlspecialchars($pedido['nome_usuario'] ?? 'Cliente removido') ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></td>
                        <td><?= htmlspecialchars($pedido['status']) ?></td>
                        <td><?= htmlspecialchars($pedido['forma_pagamento']) ?></td>
                        <td><?= htmlspecialchars($pedido['entrega']) ?></td>
                        <td style="max-width: 250px;"><?= htmlspecialchars($enderecoCompleto) ?></td>
                        <td><?= number_format($pedido['total'], 2, ',', '.') ?></td>
                        <td>
                            <a href="pedido-view.php?id=<?= $pedido['id'] ?>" class="btn btn-secondary btn-sm w-100 mb-1">Visualizar</a>
                            <a href="pedido-edit.php?id=<?= $pedido['id'] ?>" class="btn btn-success btn-sm w-100 mb-1">Editar</a>
                            <form action="" method="POST" class="d-inline">
                            <button type="submit" name="delete_pedido" value="<?= $pedido['id']; ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Tem certeza que deseja excluir este pedido?');">
                                Excluir
                            </button>
                            </form>
                        </td>
                    </tr>
<?php
}
} else {
    echo '<tr><td colspan="9"><h5 class="text-center text-muted">Nenhum Pedido Encontrado.</h5></td></tr>';
}
?>
                </tbody>
              </table>
            </div>
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
