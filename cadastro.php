<?php

  if(isset($_POST['submit']))
  {
  include('config.php');

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $data_nasc = $_POST['data_nasc'];
  $cep = $_POST['cep'];
  $rua = $_POST['rua'];
  $numero_end = $_POST['numero_end'];
  $complemento_end = $_POST['complemento_end'];
  $bairro = $_POST['bairro'];
  $cidade = $_POST['cidade'];
  $estado = $_POST['estado'];
  $senha = $_POST['senha'];
  $confirmar_senha = $_POST['confirmar_senha'];
  

  if ($senha !== $confirmar_senha) {
    echo "Erro: As senhas não coincidem!";
    exit;
  }
  
  $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

  $result = mysqli_query($conexao, "INSERT INTO cadastro(nome,email,telefone,data_nasc,cep,rua,numero_end,complemento_end,bairro,cidade,estado,senha) VALUES ('$nome','$email','$telefone','$data_nasc','$cep','$rua','$numero_end','$complemento_end','$bairro','$cidade','$estado','$senha_hash')");


  if ($result) {
        echo "Cadastro realizado com sucesso!";
    } else {               
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
  }  
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro - La Vic</title>
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
          <li class="nav-item"><a class="nav-link" href="listaprodutos.html">Produtos</a></li>
          <li class="nav-item"><a class="nav-link" href="contato.html">Contato</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Entrar ou Cadastrar-se</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Cadastro Form -->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow p-4 custom-form" style="width: 100%; max-width: 400px;">
      <h2 class="text-center mb-4">Cadastrar-se</h2>
      <form action="config.php" method="POST">
        <div class="mb-3">
          <label for="nome" class="form-label">Nome Completo</label>
          <input type="text" class="form-control" id="nome" name="nome" required placeholder="Seu nome aqui...">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" required placeholder="seuemail@exemplo.com">
        </div>
        <div class="mb-3">
          <label for="telefone" class="form-label">Telefone</label>
          <input type="tel" class="form-control" id="telefone" name="telefone" required placeholder="(XX) XXXXX-XXXX">
        </div>
        <div class="mb-3">
          <label for="data_nasc">Data de nascimento</label>
          <input type="date" class="form-control" id="data_nasc" name="data_nasc" required placeholder="dd/mm/aaaa"/>
        </div>
        <div class="mb-3">
          <label for="cep">CEP</label>
          <input type="text" class="form-control" id="cep" name="cep" required placeholder="XXXXX-XXX" />
        </div>
        <div class="mb-3">
          <label for="rua">Rua:</label>
          <input type="text" class="form-control" id="rua" name="rua" required />
        </div>
        <div class="mb-3">
          <label for="numero_end">Nº:</label>
          <input type="text" class="form-control" id="numero_end" name="numero_end" required />
        </div>
        <div class="mb-3">
          <label for="complemento_end">Complemento:</label>
          <input type="text" class="form-control" id="complemento_end" name="complemento_end" />
        </div>
        <div class="mb-3">
          <label for="bairro">Bairro:</label>
          <input type="text" class="form-control" id="bairro" name="bairro" required />
        </div>
        <div class="mb-3">
          <label for="cidade">Cidade:</label>
          <input type="text" class="form-control" id="cidade" name="cidade" required />
        </div>
        <div class="mb-3">
          <label for="estado">Estado:</label>
          <input type="text" class="form-control" id="estado" name="estado" required />
        </div>
        <div class="mb-3">
          <label for="senha" class="form-label">Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" required placeholder="Digite sua senha">
        </div>
        <div class="mb-3">
          <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
          <input type="password" class="form-control" id="confirmarsenha" name="confirmarsenha" required placeholder="Confirme sua senha">
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary btn-custom">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="assets/js/script.js"></script>
  <script src="assets/js/funcoes.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>