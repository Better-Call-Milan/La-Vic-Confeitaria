<?php
require('conexao.php');
include('verifica_login.php');

// ID do usuário logado
$id_usuario = $_SESSION['id'];

// Busca SOMENTE os pedidos do usuário
$sql = "SELECT 
            p.*, 
            u.nome AS nome_usuario,
            u.rua, u.numero, u.complemento, u.bairro, u.cidade, u.estado, u.cep
        FROM pedidos p
        LEFT JOIN usuarios u ON p.id_usuario = u.id
        WHERE p.id_usuario = $id_usuario
        ORDER BY p.id DESC";

$pedidos = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meus Pedidos - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <!-- Header -->
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

  <div class="container mt-5">
  <h2 class="text-center mb-4">Meus Pedidos</h2>
  <p class="text-center text-muted">Aqui você pode acompanhar o status das suas encomendas.</p>
  <p class="text-center text-muted" style="font-size: 0.9rem;">
    <em>Caso queira alterar algo em seu pedido, entre em contato conosco nos horários comerciais.</em>
  </p>


    <div class="container mt-4 custom-work-container">

      <?php include('mensagem.php'); ?>

      <div class="row">
        <div class="col-md-12">

          <div class="card">
            <div class="card-header">
              <h4>Lista de Pedidos
                <a href="painel_cliente.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>

            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                  <tr>
                    <th>ID</th>
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
                  if (mysqli_num_rows($pedidos) > 0) {
                    foreach ($pedidos as $pedido) {

                      // Montar endereço igual ao admin
                      $endereco = '-';
                      if (strtolower($pedido['entrega']) === 'entrega') {
                        $partes = [];
                        if (!empty($pedido['rua'])) $partes[] = $pedido['rua'];
                        if (!empty($pedido['numero'])) $partes[] = 'Nº ' . $pedido['numero'];
                        if (!empty($pedido['complemento'])) $partes[] = $pedido['complemento'];
                        if (!empty($pedido['bairro'])) $partes[] = $pedido['bairro'];
                        if (!empty($pedido['cidade'])) $partes[] = $pedido['cidade'];
                        if (!empty($pedido['estado'])) $partes[] = $pedido['estado'];
                        if (!empty($pedido['cep'])) $partes[] = 'CEP: ' . $pedido['cep'];

                        $endereco = implode(', ', $partes);
                      }
                  ?>
                    <tr>
                      <td><?= $pedido['id'] ?></td>
                      <td><?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></td>
                      <td><?= htmlspecialchars($pedido['status']) ?></td>
                      <td><?= htmlspecialchars($pedido['forma_pagamento']) ?></td>
                      <td><?= htmlspecialchars($pedido['entrega']) ?></td>
                      <td style="max-width:250px;"><?= htmlspecialchars($endereco) ?></td>
                      <td><?= number_format($pedido['total'], 2, ',', '.') ?></td>

                      <td>
                        <a href="pedido-view-user.php?id=<?= $pedido['id'] ?>" class="btn btn-secondary btn-sm w-100">
                          Visualizar
                        </a>
                      </td>
                    </tr>
                  <?php
                    }
                  } else {
                    echo '<tr><td colspan="8"><h5 class="text-center text-muted">Você ainda não fez nenhum pedido.</h5></td></tr>';
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

  <footer class="text-white text-center py-4 custom-footer">
    <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
