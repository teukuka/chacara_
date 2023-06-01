<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtém os dados enviados no corpo da requisição
  $data = $_POST;

  // Verifica se os campos obrigatórios foram recebidos corretamente
  if (isset($data['nome']) && isset($data['cpf']) && isset($data['telefone'])) {
    $nome = $data['nome'];
    $cpf = $data['cpf'];
    $telefone = $data['telefone'];
    $dataNascimento = $data['data_aniversario'];
    $nacionalidade = $data['nacionalidade'];
    $genero = $data['genero'];
    $rua = $data['rua'];
    $numero = $data['numero'];
    $cidade = $data['cidade'];
    $cep = $data['CEP'];
    $estado = $data['estado'];

    // Obtém o id_usuario do usuário logado
    session_start();
    $id_usuario = $_SESSION['id_usuario'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chacara";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão com o banco de dados
    if ($conn->connect_error) {
      die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Query para obter o usuário e email a partir do id_usuario
    $query = "SELECT usuario, email FROM usuario WHERE id_usuario = $id_usuario";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $usuario = $row['usuario'];
      $email = $row['email'];
    } else {
      echo "Usuário não encontrado!";
      exit;
    }

    // Query para inserir os dados no banco de dados
    $sql = "INSERT INTO dados_pessoal (usuario_id, nome, cpf, telefone, data_aniversario, nacionalidade, genero, rua, numero, cidade, CEP, estado)
            VALUES ('$id_usuario', '$nome', '$cpf', '$telefone', '$dataNascimento', '$nacionalidade', '$genero', '$rua', '$numero', '$cidade', '$cep', '$estado')";

    if ($conn->query($sql) === TRUE) {
      echo "<html><head><script>
        setTimeout(function() {
          window.location.href = 'newindex.php';
        }, 3000); // Redireciona após 3 segundos (3000 milissegundos)
      </script></head><body></body></html>";
      exit;
    } else {
      echo "Erro ao salvar os dados pessoais: " . $conn->error;
    }

    $conn->close();
  } else {
    // Se os campos não foram recebidos corretamente, exiba uma mensagem de erro
    echo "Erro ao receber os dados do formulário.";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dados Pessoais</title>

  <link rel="stylesheet" type="text/css" href="style5.css">

</head>

<body>
  <header>
    <div class="logo">
      <img src="logo.png" alt="Codeware">
      <span>Chácara Codeware</span>
    </div>
    <nav>
      <ul>
        <li><a href="newindex.php">Home</a></li>
        <li><a href="index.php">Sair</a></li>
      </ul>
    </nav>
  </header>
     <section class="personal-data-section">
        <div class="container">   
      <h2>Dados salvos com sucesos</h2>
      <form id="personalDataForm" action="newindex.php">
  <button id="confirmarButton" type="button">Voltar para o início</button>
</form>

<script>
  // Obtém o elemento do botão
  var confirmarButton = document.getElementById('confirmarButton');

  // Adiciona um ouvinte de evento de clique ao botão
  confirmarButton.addEventListener('click', function() {
    // Redireciona para a página especificada no atributo 'action'
    window.location.href = document.getElementById('personalDataForm').action;
  });
</script>
     </section>
  <footer>
    <p>Todos os direitos reservados &copy; 2023</p>
  </footer>

</body>

</html>