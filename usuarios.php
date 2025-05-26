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
    <h2 class="text-center mb-5">Gerenciar Usuários</h2>
    <div class="mt-5 text-center">
      <!--<h4>Resumo Recente</h4>-->
      <p class="text-muted">Adicione, leia, atualize e exclua contas de clientes e administradores.</p>
    </div>
    <div class="container mt-4 custom-work-container">
        <?php include('mensagem.php')?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h4> Lista de Usuários
                        <a href="usuario-create.php" class="btn btn-primary float-end">Adicionar usuário</a>
                    </h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOME</th>
                                    <th>EMAIL</th>
                                    <th>TELEFONE</th>
                                    <th>DATA DE NASCIMENTO</th>
                                    <th>CEP</th>
                                    <th>RUA</th>
                                    <th>NUMERO</th>
                                    <th>COMPLEMENTO</th>
                                    <th>BAIRRO</th>
                                    <th>CIDADE</th>
                                    <th>ESTADO</th>
                                    <th>SENHA</th>
                                    <th>TIPO</th>
                                    <th>DATA DO CADASTRO</th>
                                    <th>AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = 'SELECT * FROM usuarios';
                                $usuarios = mysqli_query($conexao, $sql);
                                if (mysqli_num_rows($usuarios) > 0) {
                                    foreach($usuarios as $usuario){
                                ?>
                                <tr>
                                    <td><?=$usuario['id']?></td>
                                    <td><?=$usuario['nome']?></td>
                                    <td><?=$usuario['email']?></td>
                                    <td><?=$usuario['telefone']?></td>
                                    <td><?=date('d/m/Y', strtotime($usuario['data_nascimento']))?></td>
                                    <td><?=$usuario['cep']?></td>
                                    <td><?=$usuario['rua']?></td>
                                    <td><?=$usuario['numero']?></td>
                                    <td><?=$usuario['complemento']?></td>
                                    <td><?=$usuario['bairro']?></td>
                                    <td><?=$usuario['cidade']?></td>
                                    <td><?=$usuario['estado']?></td>
                                    <td><?=$usuario['senha']?></td>
                                    <td><?=$usuario['tipo']?></td>
                                    <td><?=$usuario['data_cadastro']?></td>
                                    <td>
                                        <a href="usuario-view.php?id=<?=$usuario['id']?>" style="width: 100%; height: 100%; border-radius: 0;" class="btn btn-secondary btn-sm">Visualizar</a>
                                        <a href="usuario-edit.php?id=<?=$usuario['id']?>" style="width: 100%; height: 100%; border-radius: 0;" class="btn btn-success btn-sm">Editar</a>
                                        <form action="" method="POST" class="d-inline">
                                            <button type="submit" name="delete_usuario" value="1" style="width: 100%; height: 100%; border-radius: 0;" class="btn btn-danger btn-sm">
                                            Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                }
                                } else {
                                    echo '<h5>Nenhum Usuário Encontrado.</h5>';
                                }
                                ?>
                            </tbody>
                        </table>
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