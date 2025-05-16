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

  $result = mysqli_query($conexao, "INSERT INTO cadastro(nome,email,telefone,data_nasc,cep,rua,numero_end,complemento_end,bairro,cidade,estado,senha,confirmar_senha) VALUES ('$nome','$email','$telefone','$data_nasc','$cep','$rua','$numero_end','$complemento_end','$bairro','$cidade','$estado','$senha','$confirmar_senha')");

  if ($result) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
    
}
  
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro - Confeitaria La Vic</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <header>
        <a href="index.html"><img src="img/logo.png" alt="Confeitaria La Vic" class="logo"/></a>
    </header>
    <main>
    <section class="login-container">
      <h2>Cadastro de Cliente</h2>
    <form action="cadastro.php" method="POST">
        <label for="nome">Nome completo:</label>
        <input type="text" id="nome" name="nome" required />
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />
        <br>
        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" required placeholder="(XX) XXXXX-XXXX" />
        <br>
        <label for="data_nasc">Data de nascimento:</label>
        <input type="date" id="data_nasc" name="data_nasc" required placeholder="dd/mm/aaaa" />
        <br>
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" required placeholder="XXXXX-XXX" />
        <br>
        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua" required />
        <br>
        <label for="numero_end">Nº:</label>
        <input type="text" id="numero_end" name="numero_end" required />
        <br>
        <label for="complemento_end">Complemento:</label>
        <input type="text" id="complemento_end" name="complemento_end" />
        <br>
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" required />
        <br>
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required />
        <br>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required />
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required />
        <br>
        <label for="confirmar_senha">Confirmar senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required />
        <br>
        <button type="submit" name="submit">Cadastrar</button>   
        <br>
        <button type="button" onclick="window.location.href='login.html'">Voltar</button>
      </form>

      <div class="mensagem">Mensagem de erro ou de que deu tudo certo</div>
    </section>
    </main>

    <footer>
        <div class="rodape">
          <h3>Contato</h3>
          <p>Whatsapp: (11) XXXXX-XXXX</p>
          <p>Instagram: @XXXXXXXX</p>
          <br>
         &copy; 2025 Confeitaria La Vic. Todos os direitos reservados.
        </div>
    </footer>

  <script src="js/script.js"></script>
  <script src="js/funcoes.js"></script>
</body>
</html>
