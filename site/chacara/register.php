<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obter os dados do formulário
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
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

  // Execute a consulta SQL para inserir os dados
  $sql_insert_user = "INSERT INTO usuario (email, usuario, senha) VALUES ('$email', '$usuario', '$senha')";
  var_dump($sql_insert_user);
  if ($conn->query($sql_insert_user) === TRUE) {
    var_dump($conn->affected_rows); 
    header("Location: login.php");
    exit;
  } else {
    echo "Erro ao inserir o registro: " . $conn->error;
  }

  // Fechar a conexão com o banco de dados
  $conn->close();
}
?>


<!-- Resto do código HTML -->


<!DOCTYPE html>
<html>
<head>
  <title>Register - Sua Chácara Inesquecível</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <header>
    <div class="logo">
      <img src="logo.png" alt="Codeware">
      <span>Chacará Codeware</span>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <section class="register-section">
    <h2>Registro</h2>
   <form id="register-form" onsubmit="return validateForm()" method="post">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" onkeyup="checkUsernameAvailability()" required>
        <span id="username-availability"></span>
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Registrar">
      </div>
    </form>
  </section>

  <footer>
    <p>Todos os direitos reservados &copy; 2023</p>
  </footer>

  <script>
    function validateForm() {
      var email = document.getElementById('email').value;
      var usuario = document.getElementById('usuario').value;
      var senha = document.getElementById('senha').value;

      // Validar se os campos foram preenchidos
      if (!email || !usuario || !senha) {
        alert('Por favor, preencha todos os campos.');
        return false;
      }

      // Validar a senha com regex
      var senhaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
      if (!senhaRegex.test(senha)) {
        alert('A senha deve ter pelo menos 8 caracteres, incluindo pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.');
        return false;
      }

      // Se tudo estiver válido, envie o formulário
      return true;
    }

    function checkUsernameAvailability() {
      var username = document.getElementById('usuario').value;

      $.ajax({
        type: 'POST',
        url: 'check_username.php', // Arquivo PHP que verifica a disponibilidade do nome de usuário
        data: { username: username },
        success: function(response) {
          if (response == 'available') {
            $('#username-availability').text('Nome de usuário disponível');
            $('#username-availability').removeClass('unavailable');
            $('#username-availability').addClass('available');
          } else {
            $('#username-availability').text('Nome de usuário indisponível');
            $('#username-availability').removeClass('available');
            $('#username-availability').addClass('unavailable');
          }
        }
      });
    }
  </script>
</body>
</html>
