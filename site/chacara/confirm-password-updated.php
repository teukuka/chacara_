<?php
// Verifica se a nova senha e a confirmação de senha foram enviadas
if (isset($_POST["newPassword"]) && isset($_POST["confirmPassword"])) {
  $newPassword = $_POST["newPassword"];
  $confirmPassword = $_POST["confirmPassword"];

  // Verifica se as senhas coincidem
  if ($newPassword === $confirmPassword) {
    // Conecte-se ao banco de dados (substitua com suas próprias configurações)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chacara";

    // Crie uma conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifique se a conexão foi estabelecida corretamente
    if ($conn->connect_error) {
      die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepare uma instrução SQL para atualizar a senha
    $sql = "UPDATE usuario SET senha = ? WHERE email = ?";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
      die("Erro na preparação da declaração SQL: " . $conn->error);
    }

    // Obtém o email do formulário ou do banco de dados, dependendo do seu caso de uso
    $email = $_POST["email"];

    // Vincula os parâmetros à declaração preparada
    $stmt->bind_param("ss", $newPassword, $email);

    // Executa a declaração preparada
    if ($stmt->execute()) {
      echo "Senha atualizada com sucesso.";
    } else {
      echo "Erro ao atualizar a senha: " . $stmt->error;
    }

    // Feche a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
  } else {
    echo "As senhas não coincidem.";
  }
}
?>
