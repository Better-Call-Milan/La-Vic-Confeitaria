<?php
require('conexao.php');
include('verifica_login.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Editar Produto - La Vic</title>
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

<div class="container mt-5">
  <h2 class="text-center mb-5">Editando um Produto</h2>
  <div class="mt-5 text-center">
    <p class="text-muted">Altere as informações necessárias para atualizar um produto do catálogo.</p>
  </div>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>
              Lista de Produtos
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
            <form action="acoes.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">

              <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $produto['nome'] ?>" required>
              </div>

              <div class="mb-3">
                <label for="categoria" class="form-label">Categoria do Produto</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    
                    <?php
                    // Lista de categorias fixas
                    $categorias = ["Bolos de Sabores Variáveis", "Bolos de Aninversário", "Docinhos", "Decorados e lembrancinhas"];

                    // Categoria atual do produto
                    $categoriaAtual = $produto['categoria'];
                    ?>

                    <option value="" disabled>Selecione uma categoria</option>

                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat ?>" <?= ($cat == $categoriaAtual) ? 'selected' : '' ?>>
                            <?= $cat ?>
                        </option>
                    <?php endforeach; ?>

                </select>
              </div>

              <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" required><?= $produto['descricao'] ?></textarea>
              </div>

              <div class="mb-3">
                <label for="preco" class="form-label">Preço (R$)</label>
                <input type="number" class="form-control" id="preco" name="preco" value="<?= $produto['preco'] ?>" step="0.01" min="0" required>
              </div>

              <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Produto</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
                <?php if (!empty($produto['imagem'])): ?>
                  <p class="mt-2">Imagem atual:</p>
                  <img src="uploads/<?= $produto['imagem'] ?>" alt="Imagem atual" width="150" class="rounded shadow-sm">
                <?php endif; ?>
              </div>

              <div class="mb-3 text-center">
                <button type="submit" name="update_produto" class="btn btn-primary">Salvar Alterações</button>
              </div>
            </form>
            <?php
              } else {
                echo "<h5>Produto não encontrado.</h5>";
              }
            } else {
              echo "<h5>ID de produto não especificado.</h5>";
            }
            ?>
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
