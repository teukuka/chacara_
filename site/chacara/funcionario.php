<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obter os dados do formulário
  $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
  $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
  $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
  $funcao = isset($_POST['funcao']) ? $_POST['funcao'] : '';
  $salario = isset($_POST['salario']) ? $_POST['salario'] : '';

  // Realizar a conexão com o banco de dados
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chacara";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificar se a conexão foi estabelecida com sucesso
  if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
  }

  // Execute a consulta SQL para inserir os dados
  $sql_insert_funcionario = "INSERT INTO funcionario (nome, cpf, telefone, funcao, salario) VALUES (?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql_insert_funcionario);
  $stmt->bind_param("sssss", $nome, $cpf, $telefone, $funcao, $salario);

  if ($stmt->execute()) {
    header("Location: admin.php");
    exit;
  } else {
    echo "Erro ao inserir o registro: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Cadastrar Funcionário</title>
  <link rel="stylesheet" type="text/css" href="style8.css">
</head>

<body>
  <header>
    <div class="logo">
      <img src="logo.png" alt="Codeware">
      <span>Chácara Codeware</span>
    </div>
    <nav>
      <ul>
        <li><a href="admin.php">Home</a></li>
      </ul>
    </nav>
  </header>

  <section class="cadastro-funcionario-section">
    <div class="container">
      <h2>Cadastrar Funcionário</h2>
      <form id="cadastro-form" method="post">
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
          <label for="cpf">CPF:</label>
          <input type="text" id="cpf" name="cpf" required>
        </div>
        <div class="form-group">
          <label for="telefone">Telefone:</label>
          <input type="text" id="telefone" name="telefone" required>
        </div>
        <div class="form-group">
          <label for="funcao">Função:</label>
          <input type="text" id="funcao" name="funcao" required>
        </div>
        <div class="form-group">
          <label for="salario">Salário:</label>
          <input type="text" id="salario" name="salario" required>
        </div>
        <div class="form-group">
          <input type="submit" value="Cadastrar">
        </div>
      </form>
    </div>
  </section>

  <footer>
    <p>Todos os direitos reservados &copy; 2023</p>
  </footer>

</body>

</html>
