<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obter o email e a nova senha do formulário
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : '';

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

  // Atualizar a senha do usuário no banco de dados
  $sql = "UPDATE usuario SET senha = '$newPassword' WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result === TRUE) {
    echo "Senha atualizada com sucesso.";
    echo '<script>window.location.href = "confirm-password-updated.php";</script>';
    exit;
  } else {
    echo "Ocorreu um erro ao atualizar a senha.";
    echo '<script>window.location.href = "confirm-password-error.php";</script>';
    exit;
  }

  // Fechar a conexão com o banco de dados
  $conn->close();
}
?>
