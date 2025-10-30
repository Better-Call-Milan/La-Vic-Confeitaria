<?php
include('conexao.php');
include('verifica_login.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id']; // Fallback de segurança

// Se quiser impedir que alguém acesse o de outro, mantenha essa checagem:
if ($id != $_SESSION['id'] && $_SESSION['tipo'] != 'admin') {
    die('Acesso negado.');
}

$query = "SELECT * FROM usuarios WHERE id = $id";
$result = mysqli_query($conexao, $query);
$usuario = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meus Dados - La Vic</title>
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
          <li class="nav-item"><a class="nav-link" href="painel_cliente.php">Painel</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo -->
  <div class="container mt-5">
    <h2 class="text-center mb-5">Meus Dados</h2>
    <p class="text-muted text-center">Edite suas informações pessoais.</p>

    <div class="card">
      <div class="card-body">
        <form action="acoes.php" method="POST">
          <input type="hidden" name="usuario_id" value="<?=$usuario['id']?>">

          <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?=$usuario['nome']?>" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?=$usuario['email']?>" required>
          </div>

          <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="<?=$usuario['telefone']?>" placeholder="(XX) XXXXX-XXXX">
          </div>

          <div class="mb-3">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" value="<?=$usuario['cep']?>">
          </div>

          <div class="mb-3">
            <label for="rua">Rua</label>
            <input type="text" class="form-control" id="rua" name="rua" value="<?=$usuario['rua']?>">
          </div>

          <div class="mb-3">
            <label for="numero_end">Nº</label>
            <input type="text" class="form-control" id="numero_end" value="<?=$usuario['numero']?>" name="numero_end"  />
          </div>

          <div class="mb-3">
            <label for="complemento_end">Complemento</label>
            <input type="text" class="form-control" id="complemento_end" value="<?=$usuario['complemento']?>" name="complemento_end" />
          </div>

          <div class="mb-3">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="<?=$usuario['bairro']?>">
          </div>

          <div class="mb-3">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="<?=$usuario['cidade']?>">
          </div>

          <div class="mb-3">
            <label for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" maxlength="2" value="<?=$usuario['estado']?>" placeholder="SP">
          </div>

          <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Deixe em branco para manter a atual">
          </div>

          <div class="d-flex justify-content-start gap-2 mt-3">
            <button type="submit" name="update_meus_dados" class="btn btn-primary">Salvar Alterações</button>
            <a href="painel_cliente.php" class="btn btn-danger">Voltar</a>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-white text-center py-4 custom-footer mt-5">
    <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
