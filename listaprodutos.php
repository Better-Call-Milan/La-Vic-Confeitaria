<?php
include('conexao.php');

// Buscar todos os produtos
$sql = "SELECT * FROM produtos ORDER BY categoria, nome";
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produtos - Minha Loja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <li class="nav-item"><a class="nav-link" href="listaprodutos.php">Produtos</a></li>
        <li class="nav-item"><a class="nav-link" href="contato.html">Contato</a></li>
        <li class="nav-item"><a class="nav-link" href="entrar.php">Entrar ou Cadastrar-se</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-4">
  <h1 class="mb-4">Todos os Produtos</h1>

  <!-- Filtros -->
  <div class="row mb-4">
    <div class="col-md-3">
      <select id="categoryFilter" class="form-select">
        <option value="all" selected>Filtrar por categoria</option>
        <option value="Bolos de Sabores Variáveis">Bolos de Sabores Variáveis</option>
        <option value="Bolos de Aninversário">Bolos de Aninversário</option>
        <option value="Docinhos">Docinhos</option>
        <option value="Decorados e lembrancinhas">Decorados e lembrancinhas</option>
      </select>
    </div>
  </div>

  <!-- Grade dinâmica -->
  <div class="row">

    <?php while ($p = mysqli_fetch_assoc($result)) : ?>

      <div class="col-md-3 mb-4 product-card" data-category="<?= $p['categoria'] ?>">
        <div class="card h-100 custom-card">

          <img src="<?= $p['imagem'] ?>" class="card-img-top" alt="<?= $p['nome'] ?>">

          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $p['nome'] ?></h5>

            <p class="card-text text-success fw-bold mb-2">
              R$ <?= number_format($p['preco'], 2, ',', '.') ?>
            </p>

            <a href="entrar.php" class="btn btn-primary mt-auto btn-custom">Ver mais</a>
          </div>
        </div>
      </div>

    <?php endwhile; ?>

  </div>
</div>

<footer class="text-white text-center py-4 custom-footer">
  <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
</footer>

<script src="assets/js/dropdown.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
