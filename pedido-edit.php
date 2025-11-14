<?php
require('conexao.php');
include('verifica_login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Editar Pedido - La Vic</title>
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
  <h2 class="text-center mb-5">Editando um Pedido</h2>
  <p class="text-center text-muted">Atualize as informações necessárias deste pedido.</p>

  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card shadow-sm">
        <div class="card-header">
          <h4>Editar Pedido
            <a href="pedidos.php" class="btn btn-danger float-end">Voltar</a>
          </h4>
        </div>
        <div class="card-body">
          <?php
          if (isset($_GET['id'])) {
            $pedido_id = mysqli_real_escape_string($conexao, $_GET['id']);

            // Consulta com todos os dados do usuário
            $sql = "SELECT 
                      p.*, 
                      u.nome AS nome_usuario, 
                      u.email, 
                      u.telefone
                    FROM pedidos p
                    LEFT JOIN usuarios u ON p.id_usuario = u.id
                    WHERE p.id = '$pedido_id'";
            $query = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($query) > 0) {
              $pedido = mysqli_fetch_array($query);
          ?>
          <form action="acoes.php" method="POST">
            <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
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

            <div class="row mb-3">
              <div class="col-md-4">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                  <option value="Pendente" <?= $pedido['status'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                  <option value="Em progresso" <?= $pedido['status'] == 'Em progresso' ? 'selected' : '' ?>>Em progresso</option>
                  <option value="A caminho" <?= $pedido['status'] == 'A caminho' ? 'selected' : '' ?>>A caminho</option>
                  <option value="Entregue" <?= $pedido['status'] == 'Entregue' ? 'selected' : '' ?>>Entregue</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Forma de Pagamento</label>
                <select class="form-select" name="forma_pagamento" required>
                  <option value="Dinheiro" <?= $pedido['forma_pagamento'] == 'Dinheiro' ? 'selected' : '' ?>>Dinheiro</option>
                  <option value="Débito" <?= $pedido['forma_pagamento'] == 'Débito' ? 'selected' : '' ?>>Débito</option>
                  <option value="Crédito" <?= $pedido['forma_pagamento'] == 'Crédito' ? 'selected' : '' ?>>Crédito</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Tipo de Entrega</label>
                <select class="form-select" name="entrega" required>
                  <option value="entrega" <?= strtolower($pedido['entrega']) == 'entrega' ? 'selected' : '' ?>>Entrega</option>
                  <option value="retirada" <?= strtolower($pedido['entrega']) == 'retirada' ? 'selected' : '' ?>>Retirada</option>
                </select>
              </div>
            </div>

            <div class="mb-3 text-center">
              <button type="submit" name="update_pedido" class="btn btn-primary px-5">Salvar Alterações</button>
            </div>
          </form>

          <?php
            } else {
              echo "<h5>Pedido não encontrado.</h5>";
            }
          } else {
            echo "<h5>ID do pedido não especificado.</h5>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="text-white text-center py-4 custom-footer">
  <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
