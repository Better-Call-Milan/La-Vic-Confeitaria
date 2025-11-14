<?php
require('conexao.php');
include('verifica_login.php');

// Buscar produtos disponíveis
$query_produtos = "SELECT id, nome, preco FROM produtos ORDER BY nome ASC";
$result_produtos = mysqli_query($conexao, $query_produtos);

// Buscar usuários (clientes)
$query_usuarios = "SELECT id, nome FROM usuarios WHERE tipo = 'cliente' ORDER BY nome ASC";
$result_usuarios = mysqli_query($conexao, $query_usuarios);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Novo Pedido - La Vic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script>
    function adicionarProduto() {
      const produtosContainer = document.getElementById('produtos-container');
      const index = produtosContainer.children.length;

      const produtoRow = document.createElement('div');
      produtoRow.classList.add('row', 'mb-3', 'align-items-end');
      produtoRow.innerHTML = `
        <div class="col-md-6">
          <label class="form-label">Produto</label>
          <select name="produtos[${index}][id]" class="form-select produto-select" required onchange="atualizarTotal()">
            <option value="">Selecione um produto</option>
            <?php while($p = mysqli_fetch_assoc($result_produtos)): ?>
              <option value="<?= $p['id'] ?>" data-preco="<?= $p['preco'] ?>">
                <?= htmlspecialchars($p['nome']) ?> - R$ <?= number_format($p['preco'], 2, ',', '.') ?>
              </option>
            <?php endwhile; mysqli_data_seek($result_produtos, 0); ?>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Quantidade</label>
          <input type="number" name="produtos[${index}][quantidade]" class="form-control quantidade-input" min="1" value="1" required onchange="atualizarTotal()">
        </div>
        <div class="col-md-2">
          <label class="form-label">Subtotal</label>
          <input type="text" class="form-control subtotal" value="R$ 0,00" readonly>
        </div>
        <div class="col-md-1 text-center">
          <button type="button" class="btn btn-danger" onclick="this.closest('.row').remove(); atualizarTotal();">Excluir</button>
        </div>
      `;
      produtosContainer.appendChild(produtoRow);
      atualizarTotal();
    }

    function atualizarTotal() {
      let total = 0;
      document.querySelectorAll('.produto-select').forEach((select, i) => {
        const preco = parseFloat(select.options[select.selectedIndex]?.dataset.preco || 0);
        const quantidade = parseInt(document.querySelectorAll('.quantidade-input')[i]?.value || 0);
        const subtotal = preco * quantidade;
        document.querySelectorAll('.subtotal')[i].value = subtotal ? 'R$ ' + subtotal.toFixed(2).replace('.', ',') : 'R$ 0,00';
        total += subtotal;
      });
      document.getElementById('total').value = 'R$ ' + total.toFixed(2).replace('.', ',');
    }
  </script>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container">
      <a class="navbar-brand" href="painel_admin.php">
        <img src="assets/img/logo.png" alt="Confeitaria La Vic" height="70">
      </a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="contato-user.html">Contato</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo -->
  <div class="container mt-5">
    <h2 class="text-center mb-5">Criar Novo Pedido</h2>
    <div class="text-center mb-4 text-muted">Adicione produtos, selecione o cliente e finalize o pedido.</div>

    <div class="card">
      <div class="card-header">
        <h4>Novo Pedido
          <a href="pedidos.php" class="btn btn-danger float-end">Voltar</a>
        </h4>
      </div>
      <div class="card-body">
        <form action="acoes.php" method="POST">
          <!-- Cliente -->
          <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="id_usuario" class="form-select" required>
              <option value="">Selecione o cliente</option>
              <?php while($u = mysqli_fetch_assoc($result_usuarios)): ?>
                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nome']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <!-- Forma de Pagamento -->
          <div class="mb-3">
            <label class="form-label">Forma de Pagamento</label>
            <select name="forma_pagamento" class="form-select" required>
              <option value="Dinheiro">Dinheiro</option>
              <option value="Débito">Débito</option>
              <option value="Crédito">Crédito</option>
            </select>
          </div>

          <!-- Entrega -->
          <div class="mb-3">
            <label class="form-label">Tipo de Entrega</label>
            <select name="entrega" class="form-select" required>
              <option value="Entrega">Entrega no endereço</option>
              <option value="Retirada">Retirada no local</option>
            </select>
          </div>

          <!-- Produtos -->
          <div class="mb-4">
            <label class="form-label fw-bold">Produtos do Pedido</label>
            <div id="produtos-container"></div>
            <button type="button" class="btn btn-success mt-3" onclick="adicionarProduto()">+ Adicionar Produto</button>
          </div>

          <!-- Total -->
          <div class="mb-3">
            <label class="form-label">Total</label>
            <input type="text" id="total" name="total" class="form-control" readonly value="R$ 0,00">
          </div>

          <!-- Botão -->
          <div class="text-center">
            <button type="submit" name="create_pedido" class="btn btn-primary px-4">Salvar Pedido</button>
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
