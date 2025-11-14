<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css"> <!-- Seu CSS personalizado -->
</head>
<body>

  <!-- Navbar -->
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
          <li class="nav-item"><a class="nav-link" href="listaprodutos.php">Produtos</a></li>
          <li class="nav-item"><a class="nav-link" href="contato.html">Contato</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4 custom-form" style="width: 100%; max-width: 400px;">
      <h2 class="text-center mb-4">Entrar na conta</h2>
      <form id="loginForm" action="login.php" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required placeholder="seuemail@exemplo.com">
        </div>
        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" required placeholder="Digite sua senha">
        </div>
        <!--<div class="mb-3"> Não precisamos
        <label for="tipo" class="form-label">Tipo de acesso</label>
        <select class="form-select custom-select" id="tipo" name="tipo" required>
            <option value="cliente" selected>Cliente</option>
            <option value="admin">Administrador</option>
        </select>
        </div>-->
        <div class="d-grid">
          <button type="submit" class="btn btn-primary btn-custom">Entrar</button>
        </div>
      </form>
      <div class="text-center mt-3">
        <!--Isso aqui só aparece qndo o usuario não fez direito -->
        <?php
        if(isset($_SESSION['nao_autenticado'])):
        ?>
        <p class="custom-link">ERRO: Usuário ou senha inválidos!</p>
        <?php
        endif;
        unset($_SESSION['nao_autenticado']);
        ?>
        <a class="custom-link" href="cadastro.php">Não tem conta? Cadastre-se</a>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class=" text-white text-center py-4 custom-footer">
    <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
  </footer>

  <!-- Bootstrap JS & JS -->
  <script src="assets/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>