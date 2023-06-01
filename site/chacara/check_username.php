<?php
// Obter o nome de usuário enviado por meio do método POST
$username = isset($_POST['username']) ? $_POST['username'] : '';

// Realizar a conexão com o banco de dados
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "chacara";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o nome de usuário já existe no banco de dados
$sql_check_username = "SELECT * FROM usuario WHERE usuario = '$username'";
$result_check_username = $conn->query($sql_check_username);

if ($result_check_username && $result_check_username->num_rows > 0) {
  // Nome de usuário indisponível
  echo 'unavailable';
} else {
  // Nome de usuário disponível
  echo 'available';
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
