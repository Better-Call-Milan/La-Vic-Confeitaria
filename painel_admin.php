<?php
include('conexao.php');
include('verifica_login.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Dashboard - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Header / Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
      <!--Logo-->
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

  <div class="container mt-5">
    <h2 class="text-center mb-5">Painel do Administrador</h2>
    <div class="mt-5 text-center">
      <!--<h4>Resumo Recente</h4>-->
      <p class="text-muted">Olá! Essa é a sua área de trabalho, sinta-se à vontade para cuidar dos seus negócios.</p>
    </div>
    <div class="row justify-content-center g-4">
      <div class="col-md-4 col-lg-3">
        <div class="card custom-card text-white bg-primary">
          <div class="card-body text-center">
            <h5 class="card-title">Produtos</h5>
            <p class="card-text">Adicione ou remova da vitrine</p>
            <a href="produtos.php" class="btn btn-light btn-sm">Gerenciar</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-3">
        <div class="card custom-card text-white bg-success">
          <div class="card-body text-center">
            <h5 class="card-title">Pedidos</h5>
            <p class="card-text">Veja todas as encomendas</p>
            <a href="pedidos-view.php" class="btn btn-light btn-sm">Ver Pedidos</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-3">
        <div class="card custom-card text-white bg-warning">
          <div class="card-body text-center">
            <h5 class="card-title">Usuários</h5>
            <p class="card-text">Saiba quem está comprando</p>
            <a href="usuarios.php" class="btn btn-light btn-sm">Gerenciar</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class=" text-white text-center py-4 custom-footer">
    <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>