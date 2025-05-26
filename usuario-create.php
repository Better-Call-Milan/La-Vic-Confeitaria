<?php
require('conexao.php');
include('verifica_login.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Gerenciar Usuários - La Vic</title>
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
    <h2 class="text-center mb-5">Adicionando um Usuário</h2>
    <div class="mt-5 text-center">
      <!--<h4>Resumo Recente</h4>-->
      <p class="text-muted">Preencha tudo de forma adequada para criar um perfil de cliente ou um admin.</p>
    </div>
    <div class="container mt-4 ">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h4> Lista de Usuários
                        <a href="usuarios.php" class="btn btn-danger float-end">Voltar</a>
                    </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes.php" method="POST">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo de acesso</label>
                                    <select id="tipo" name="tipo" required>
                                        <option value="cliente">Cliente</option>
                                        <option value="admin">Administrador</option>
                                    </select>
                                    </div>
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
                                    <input type="tel" class="form-control" id="telefone" name="telefone" required placeholder="(XX) XXXXX-XXXX"
                                    maxlength="15" pattern="\(\d{2}\)\s?\d{4,5}-\d{4}" title="Formato esperado: (XX) XXXXX-XXXX">
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
                                    <label for="rua">Rua</label>
                                    <input type="text" class="form-control" id="rua" name="rua" required />
                                    </div>
                                    <div class="mb-3">
                                    <label for="numero_end">Nº</label>
                                    <input type="text" class="form-control" id="numero_end" name="numero_end" required />
                                    </div>
                                    <div class="mb-3">
                                    <label for="complemento_end">Complemento</label>
                                    <input type="text" class="form-control" id="complemento_end" name="complemento_end" />
                                    </div>
                                    <div class="mb-3">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" required />
                                    </div>
                                    <div class="mb-3">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" required />
                                    </div>
                                    <div class="mb-3">
                                    <label for="estado">Estado</label>
                                    <input type="text" class="form-control" id="estado" name="estado" maxlength="2" required placeholder="SP" style="text-transform:uppercase;" pattern="[A-Za-z]{2}" title="Apenas a sigla do estado com 2 letras. Ex: SP, RJ">
                                    </div>
                                    <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="senha" name="senha" required placeholder="Digite sua senha">
                                    <small id="senhaFeedback" class="form-text text-muted"></small>
                                    </div>
                                    <div class="mb-3">
                                    <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                                    <input type="password" class="form-control" id="confirmarsenha" name="confirmar_senha" required placeholder="Confirme sua senha">
                                    <small id="confirmarSenhaFeedback" class="form-text text-muted"></small>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="create_usuario" class="btn btn-primary">Salvar</button>
                                    </div>
                            </div>
                        </form>
                    </div>
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