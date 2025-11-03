<?php
require('conexao.php');
include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Adicionar Produto - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Header / Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
      <!--Logo-->
      <a class="navbar-brand" href="painel_admin.php">
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

  <div class="container mt-5">
    <h2 class="text-center mb-5">Adicionar Produto</h2>
    <div class="mt-5 text-center">
      <p class="text-muted">Preencha as informações abaixo para adicionar um novo produto à vitrine.</p>
    </div>

    <div class="container mt-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4> Novo Produto
                <a href="produtos.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <form action="acoes.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nome" class="form-label">Nome do Produto</label>
                  <input type="text" class="form-control" id="nome" name="nome" required placeholder="Ex: Bolo de Chocolate">
                </div>

                <div class="mb-3">
                  <label for="descricao" class="form-label">Descrição</label>
                  <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Descreva o produto..."></textarea>
                </div>

                <div class="mb-3">
                  <label for="preco" class="form-label">Preço (R$)</label>
                  <input type="number" class="form-control" id="preco" name="preco" step="0.01" required placeholder="Ex: 29.90">
                </div>

                <div class="mb-3">
                  <label for="imagem" class="form-label">Imagem do Produto</label>
                  <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                  <small class="text-muted">Formatos aceitos: JPG, PNG, WEBP.</small>
                </div>

                <div class="mb-3 text-center">
                  <button type="submit" name="create_produto" class="btn btn-primary px-4">Salvar</button>
                </div>
              </form>
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
