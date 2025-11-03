<?php
require('conexao.php');
include('verifica_login.php');

// Verifica se o botão "Excluir" foi clicado
if (isset($_POST['delete_produto'])) {
    $id_produto = intval($_POST['delete_produto']);

    // Busca o produto antes de excluir (para deletar imagem se houver)
    $query = "SELECT imagem FROM produtos WHERE id = $id_produto";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $produto = mysqli_fetch_assoc($resultado);

        // Exclui imagem do servidor, se existir
        if (!empty($produto['imagem']) && file_exists($produto['imagem'])) {
            unlink($produto['imagem']);
        }

        // Deleta o produto do banco de dados
        $delete_query = "DELETE FROM produtos WHERE id = $id_produto";
        if (mysqli_query($conexao, $delete_query)) {
            $_SESSION['mensagem'] = "Produto excluído com sucesso!";
            $_SESSION['tipo_mensagem'] = "success";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir o produto.";
            $_SESSION['tipo_mensagem'] = "danger";
        }
    } else {
        $_SESSION['mensagem'] = "Produto não encontrado.";
        $_SESSION['tipo_mensagem'] = "warning";
    }

    // Redireciona para evitar reenvio do formulário ao atualizar a página
    header("Location: produtos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Gerenciar Produtos - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!-- Header / Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="index.html">
        <img src="assets/img/logo.png" alt="Confeitaria La Vic" height="70">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="painel_admin.php">Painel</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2 class="text-center mb-5">Gerenciar Produtos</h2>
    <div class="mt-5 text-center">
      <p class="text-muted">Adicione, edite ou remova produtos da vitrine da confeitaria.</p>
    </div>

    <div class="container mt-4 custom-work-container">
      <?php include('mensagem.php'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4> Lista de Produtos
                <a href="painel_admin.php" class="btn btn-danger float-end">Voltar</a>
                <a href="produto-create.php" class="btn btn-primary float-end me-2">Adicionar Produto</a>
              </h4>
            </div>

            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                  <tr>
                    <th>Imagem</th>
                    <th>ID</th>
                    <th>Preço (R$)</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM produtos ORDER BY id ASC";
                  $produtos = mysqli_query($conexao, $sql);

                  if (mysqli_num_rows($produtos) > 0) {
                    foreach ($produtos as $produto) {
                      ?>
                      <tr>
                        <td>
                          <?php if (!empty($produto['imagem'])): ?>
                            <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" style="max-width: 100px; border-radius: 8px;">
                          <?php else: ?>
                            <span class="text-muted">Sem imagem</span>
                          <?php endif; ?>
                        </td>
                        <td><?= $produto['id'] ?></td>
                        <td><?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td style="max-width: 300px; text-align: left;"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></td>
                        <td>
                          <a href="produto-view.php?id=<?= $produto['id'] ?>" class="btn btn-secondary btn-sm w-100 mb-1">Visualizar</a>
                          <a href="produto-edit.php?id=<?= $produto['id'] ?>" class="btn btn-success btn-sm w-100 mb-1">Editar</a>
                          <form action="" method="POST" class="d-inline">
                            <button type="submit" name="delete_produto" value="<?= $produto['id']; ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Tem certeza que deseja excluir este produto?');">
                                Excluir
                            </button>
                          </form>

                        </td>
                      </tr>
                      <?php
                    }
                  } else {
                    echo '<tr><td colspan="6"><h5 class="text-center text-muted">Nenhum Produto Encontrado.</h5></td></tr>';
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
  <footer class="text-white text-center py-4 custom-footer">
    <p>&copy; 2025 Confeitaria La Vic. Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
