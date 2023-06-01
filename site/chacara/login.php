<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obter os dados do formulário
  $usuario_email = isset($_POST['usuario_email']) ? $_POST['usuario_email'] : '';
  $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

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

  // Consulta SQL para verificar o usuário ou email e senha no banco de dados
  $sql = "SELECT * FROM usuario WHERE (usuario = '$usuario_email' OR email = '$usuario_email') AND senha = '$senha'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // Iniciar a sessão
  session_start();

  // Obter o ID do usuário a partir do resultado da consulta
  $row = $result->fetch_assoc();
  $id_usuario = $row['id_usuario'];

  // Armazenar o ID do usuário na sessão
  $_SESSION['id_usuario'] = $id_usuario;

  // Definir a variável "logged_in" como true
  $_SESSION['logged_in'] = true;

  // Usuário autenticado, redirecionar para a página desejada
  header("Location: newindex.php");
  exit;
}
else {
    echo "Usuário ou senha inválidos.";
  }

  // Fechar a conexão com o banco de dados
  $conn->close();
}
?>

<!-- Resto do código HTML -->

<!DOCTYPE html>
<html>

<head>
  <title>Login - Sua Chácara Inesquecível</title>
  <link rel="stylesheet" type="text/css" href="style3.css">
</head>

<body>
  <!-- Cabeçalho -->
  <header>
        <div class="logo">
            <img src="logo.png" alt="Codeware">
            <span>Chacará Codeware</span>
        </div>
        <nav>
            <ul>
                <li><a href="register.php">Registrar</a></li>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>
  <!-- Seção de Login -->
  <section class="login-section">
    <h2>Logar</h2>
    <form method="post">
      <div class="form-group">
        <label for="usuario">Usuário/Email:</label>
        <input type="text" id="usuario" name="usuario_email" required>
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Logar">
        <a href="register.php"><button type="button">Criar Conta</button></a>
      </div>
      <div class="form-group">
        <p><a href="esqueceuSenha.php">Esqueceu a senha?</a></p>
      </div>
    </form>
  </section>

  <!-- Rodapé -->
  <footer>
    <p>Todos os direitos reservados &copy; 2023</p>
  </footer>

</body>

</html>

