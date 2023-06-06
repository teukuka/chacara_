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
    $sql = "SELECT * FROM dados_pessoal WHERE usuario_id = $id_usuario";
    $resultDadosPessoais = $conn->query($sql);

    if ($resultDadosPessoais->num_rows <= 0) {
      // Inserir os dados pessoais no banco de dados
      $sql = "INSERT INTO dados_pessoal (nome, cpf, telefone, data_aniversario, nacionalidade, genero, rua, numero, cidade, cep, estado, usuario_id) VALUES ('$nome', '$cpf', '$telefone', '$dataNascimento', '$nacionalidade', '$genero', '$rua', '$numero', '$cidade', '$cep', '$estado', $id_usuario)";

      if ($conn->query($sql) === true) {
        // Dados pessoais inseridos com sucesso
        echo "Dados pessoais inseridos com sucesso!";
      } else {
        // Erro ao inserir dados pessoais
        echo "Erro ao inserir dados pessoais: " . $conn->error;
      }
    } else {
      // Atualizar os dados pessoais no banco de dados
      $sql = "UPDATE dados_pessoal SET nome='$nome', cpf='$cpf', telefone='$telefone', data_aniversario='$dataNascimento', nacionalidade='$nacionalidade', genero='$genero', rua='$rua', numero='$numero', cidade='$cidade', cep='$cep', estado='$estado' WHERE usuario_id = $id_usuario";

      if ($conn->query($sql) === true) {
        // Dados pessoais atualizados com sucesso
        echo "Dados pessoais atualizados com sucesso!";
      } else {
        // Erro ao atualizar dados pessoais
        echo "Erro ao atualizar dados pessoais: " . $conn->error;
      }
    }

    $conn->close();
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
      <h2>Dados salvos com sucesso</h2>
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
    </div>
  </section>
  <footer>
    <p>Todos os direitos reservados &copy; 2023</p>
  </footer>
</body>

</html>
