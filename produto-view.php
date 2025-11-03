<?php
require('conexao.php');
include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Visualizar Produto - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Header / Navbar -->
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
          <li class="nav-item"><a class="nav-link" href="contato.html">Contato</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo principal -->
  <div class="container mt-5">
    <h2 class="text-center mb-5">Visualizando um Produto</h2>
    <div class="text-center mb-4">
      <p class="text-muted">Confira os detalhes do produto selecionado.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm">
          <div class="card-header">
            <h4>Detalhes do Produto
              <a href="produtos.php" class="btn btn-danger float-end">Voltar</a>
            </h4>
          </div>
          <div class="card-body">
            <?php 
            if (isset($_GET['id'])) {
              $produto_id = mysqli_real_escape_string($conexao, $_GET['id']);
              $sql = "SELECT * FROM produtos WHERE id='$produto_id'";
              $query = mysqli_query($conexao, $sql);

              if (mysqli_num_rows($query) > 0) {
                $produto = mysqli_fetch_array($query);
            ?>
              <div class="row">
                <!-- Imagem do produto -->
                <div class="col-md-4 text-center mb-3">
                  <?php if (!empty($produto['imagem'])): ?>
                    <img src="<?= htmlspecialchars($produto['imagem']); ?>" 
                         alt="<?= htmlspecialchars($produto['nome']); ?>" 
                         class="img-fluid rounded shadow-sm" 
                         style="max-height: 250px;">
                  <?php else: ?>
                    <div class="border p-5 bg-light text-muted rounded">Sem imagem disponível</div>
                  <?php endif; ?>
                </div>

                <!-- Detalhes do produto -->
                <div class="col-md-8">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Nome</label>
                    <p class="form-control"><?= htmlspecialchars($produto['nome']); ?></p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold">Descrição</label>
                    <p class="form-control" style="height:auto; min-height:80px;"><?= nl2br(htmlspecialchars($produto['descricao'])); ?></p>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold">Preço</label>
                    <p class="form-control">R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></p>
                  </div>
              </div>
            <?php
              } else {
                echo "<h5>Produto não encontrado.</h5>";
              }
            } else {
              echo "<h5>ID do produto não informado.</h5>";
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
