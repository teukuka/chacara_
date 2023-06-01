<?php
// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Configurações de conexão ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chacara";

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se houve um erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    $email = $_POST['email'];

    // Consulta SQL para verificar se o email existe no banco de dados
    $query = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o email existe no banco de dados
    if ($result->num_rows > 0) {
        // Se o email existe, exibe os campos de nova senha e confirmar senha
        echo '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Esqueceu a Senha</title>
                <link rel="stylesheet" type="text/css" href="style6.css">
            </head>
            <body>
                <header>
                    <!-- Seu código HTML para o cabeçalho aqui -->
                </header>
            
                <section class="forgot-password-section">
                    <div class="container">
                        <h2>Esqueceu a Senha</h2>
                        <form action="confirm-password-updated.php" method="post">
                            <input type="hidden" name="email" value="' . $email . '">
                            <div class="form-group">
                                <label for="newPassword">Nova Senha:</label>
                                <input type="password" id="newPassword" name="newPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirmar Senha:</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit">Confirmar</button>
                            </div>
                        </form>
                    </div>
                </section>
            
                <footer>
                    <!-- Seu código HTML para o rodapé aqui -->
                </footer>
            </body>
            </html>
        ';
    } else {
        // Se o email não existe, exibe uma mensagem de erro
        echo '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Email Inválido</title>
                <link rel="stylesheet" type="text/css" href="style6.css">
            </head>
            <body>
                <header>
                    <!-- Seu código HTML para o cabeçalho aqui -->
                </header>
            
                <section class="forgot-password-section">
                    <div class="container">
                        <h2>Email Inválido</h2>
                        <p>O email fornecido não está cadastrado. Por favor, insira um email válido.</p>
                        <a href="esqueceuSenha.php">Voltar</a>
                    </div>
                </section>
            
                <footer>
                    <!-- Seu código HTML para o rodapé aqui -->
                </footer>
            </body>
            </html>
        ';
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    exit; // Adicionado para evitar a execução do código abaixo
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Esqueceu a Senha</title>
  <link rel="stylesheet" type="text/css" href="style6.css">
</head>
<body>
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

  <section class="forgot-password-section">
    <div class="container">
      <h2>Esqueceu a Senha</h2>
      <form action="" method="post">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <button type="submit" name="submit">Confirmar</button>
        </div>
      </form>
    </div>
  </section>

  <footer>
     <p>Todos os direitos reservados &copy; 2023</p>
  </footer>
</body>
</html>
