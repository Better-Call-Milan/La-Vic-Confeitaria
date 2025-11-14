<?php
include('conexao.php');
include('verifica_login.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel do Cliente - La Vic</title>
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
          <li class="nav-item"><a class="nav-link" href="contato-user.html">Contato</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo principal -->

  <div class="container mt-5">
    <h2 class="text-center mb-5">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</h2>

    <!--Mensagem de atualização de dados-->
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'atualizado'): ?>
    <div class="alert alert-success text-center">Dados atualizados com sucesso!</div>
    <?php elseif (isset($_GET['msg']) && $_GET['msg'] == 'sem_alteracao'): ?>
    <div class="alert alert-warning text-center">Nenhuma alteração detectada.</div>
    <?php endif; ?>


    <div class="mt-5 text-center">
      <!--<h4>Resumo Recente</h4>-->
      <p class="text-muted">Está com fome? Escolha o doce certo para a ocasião e faça suas compras!</p>
    </div>
    <div class="row justify-content-center g-4">
      <div class="col-md-4 col-lg-3">
        <div class="card custom-card text-white bg-primary">
          <div class="card-body text-center">
            <h5 class="card-title">Fazer um Pedido</h5>
            <p class="card-text">Venha ver nossas delícias!</p>
            <a href="pedido-create-user.php" class="btn btn-light btn-sm">Avançar</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-3">
        <div class="card custom-card text-white bg-success">
          <div class="card-body text-center">
            <h5 class="card-title">Meus Pedidos</h5>
            <p class="card-text">Ansioso? Acompanhe seu pedido!</p>
            <a href="pedidos-user.php" class="btn btn-light btn-sm">Verificar</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-lg-3">
        <div class="card custom-card text-white bg-warning">
          <div class="card-body text-center">
            <h5 class="card-title">Alterar Dados</h5>
            <p class="card-text">Precisa corrigir algo?</p>

            <a href="meus-dados-edit.php?id=<?= $_SESSION['id'] ?>" class="btn btn-light btn-sm">Gerenciar</a>


          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class=" text-white text-center py-4 custom-footer">
    <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>