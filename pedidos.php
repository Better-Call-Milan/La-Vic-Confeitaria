<?php
require('conexao.php');
include('verifica_login.php');

// Aqui você pode buscar os produtos do banco para preencher o select:
$produtos = mysqli_query($conexao, "SELECT id, nome FROM produtos");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Criar Pedido - La Vic</title>
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
          <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>

<div class="container mt-5">
  <h2 class="text-center mb-5">Novo Pedido</h2>
  <p class="text-muted text-center">Selecione os produtos e quantidades desejadas.</p>

  <form action="acoes.php" method="POST">
    <div id="produtosContainer">
      <div class="row mb-3 produto-item">
        <div class="col-md-6">
          <label for="id_produto[]" class="form-label">Produto</label>
          <select name="id_produto[]" class="form-select" required>
            <option value="">Selecione um produto</option>
            <?php while($p = mysqli_fetch_assoc($produtos)): ?>
              <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label for="quantidade[]" class="form-label">Quantidade</label>
          <input type="number" name="quantidade[]" class="form-control" min="1" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button type="button" class="btn btn-danger btn-remover">Remover</button>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <button type="button" id="adicionarProduto" class="btn btn-secondary">Adicionar Produto</button>
    </div>
    <div class="mb-3">
      <button type="submit" name="create_pedido" class="btn btn-primary">Salvar Pedido</button>
    </div>
  </form>
</div>

<!-- Footer -->
<footer class="text-white text-center py-4 custom-footer">
  <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Adicionar novo produto
  document.getElementById('adicionarProduto').addEventListener('click', function () {
    const container = document.getElementById('produtosContainer');
    const item = container.querySelector('.produto-item');
    const clone = item.cloneNode(true);
    clone.querySelectorAll('input, select').forEach(input => input.value = '');
    container.appendChild(clone);
  });

  // Remover item
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-remover')) {
      const item = e.target.closest('.produto-item');
      if (document.querySelectorAll('.produto-item').length > 1) {
        item.remove();
      }
    }
  });
</script>
</body>
</html>
