<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  // Usuário não está logado, redirecionar para a página de login
  header("Location: login.php");
  exit;
}

// Obtém o ID do usuário da sessão
$idUsuario = $_SESSION['id_usuario'];

// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chacara";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão com o banco de dados
if ($conn->connect_error) {
  die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta os detalhes do usuário no banco de dados
$sql = "SELECT usuario, email FROM usuario WHERE id_usuario = $idUsuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Usuário encontrado, obtém os detalhes
  $row = $result->fetch_assoc();
  $usuario = $row['usuario'];
  $email = $row['email'];
} else {
  // Usuário não encontrado, redireciona para a página de login
  header("Location: login.php");
  exit;
}

$sql = "SELECT * FROM dados_pessoal WHERE usuario_id = $idUsuario";
$resultDadosPessoais = $conn->query($sql);
if ($resultDadosPessoais->num_rows > 0) {
  // Dados pessoais encontrados, exibe os dados
  $dadosPessoais = $resultDadosPessoais->fetch_assoc();
  $nome = isset($dadosPessoais['Nome']) ? $dadosPessoais['Nome'] : "";
  $cpf = isset($dadosPessoais['CPF']) ? $dadosPessoais['CPF'] : "";
  $telefone = isset($dadosPessoais['Telefone']) ? $dadosPessoais['Telefone'] : "";
  $dataNascimento = isset($dadosPessoais['data_aniversario']) ? $dadosPessoais['data_aniversario'] : "";
  $nacionalidade = isset($dadosPessoais['nacionalidade']) ? $dadosPessoais['nacionalidade'] : "";
  $genero = isset($dadosPessoais['genero']) ? $dadosPessoais['genero'] : "";
  $rua = isset($dadosPessoais['rua']) ? $dadosPessoais['rua'] : "";
  $numero = isset($dadosPessoais['numero']) ? $dadosPessoais['numero'] : "";
  $cidade = isset($dadosPessoais['cidade']) ? $dadosPessoais['cidade'] : "";
  $cep = isset($dadosPessoais['CEP']) ? $dadosPessoais['CEP'] : "";
  $estado = isset($dadosPessoais['estado']) ? $dadosPessoais['estado'] : "";
} else {
  // Dados pessoais não encontrados
  $nome = "";
  $cpf = "";
  $telefone = "";
  $dataNascimento = "";
  $nacionalidade = "";
  $genero = "";
  $rua = "";
  $numero = "";
  $cidade = "";
  $cep = "";
  $estado = "";
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dados Pessoais</title>

  <link rel="stylesheet" type="text/css" href="style5.css">

<script>
  function habilitarCampos() {
    var inputs = document.querySelectorAll('.form-group input, .form-group select');
    for (var i = 0; i < inputs.length; i++) {
      inputs[i].disabled = false;
    }
    document.getElementById('alterarButton').style.display = 'none';
    document.getElementById('confirmarButton').style.display = 'block';
  }
  function enviarDados() {
      var form = document.getElementById('personalDataForm'); // Obtém o elemento do formulário
    form.action = 'salvar_dados_pessoais.php'; // Define a ação do formulário para 'salvar_dados_pessoais.php'
    form.method = 'POST'; // Define o método do formulário como POST
    form.submit(); // Envia o formulário
  }
</script>

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
    <h2>Dados Pessoais</h2>
    <form id="personalDataForm" method="post">
  <div class="form-group">
    <label for="usuario">Usuário:</label>
    <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>" disabled>
  </div>
  <!-- Restante dos campos do formulário -->
  <div class="form-group">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="telefone">Telefone:</label>
    <input type="text" id="telefone" name="telefone" value="<?php echo $telefone; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="data_aniversario">Data de Aniversário:</label>
    <input type="date" id="data_aniversario" name="data_aniversario" value="<?php echo $dataNascimento; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="nacionalidade">Nacionalidade:</label>
    <input type="text" id="nacionalidade" name="nacionalidade" value="<?php echo $nacionalidade; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="genero">Gênero:</label>
    <select id="genero" name="genero" disabled>
      <option value="masculino" <?php if ($genero == 'masculino') echo 'selected'; ?>>Masculino</option>
      <option value="feminino" <?php if ($genero == 'feminino') echo 'selected'; ?>>Feminino</option>
      <option value="outro" <?php if ($genero == 'outro') echo 'selected'; ?>>Outro</option>
    </select>
  </div>
  <div class="form-group">
    <label for="rua">Rua:</label>
    <input type="text" id="rua" name="rua" value="<?php echo $rua; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="numero">Número:</label>
    <input type="text" id="numero" name="numero" value="<?php echo $numero; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?php echo $cidade; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="CEP">CEP:</label>
    <input type="text" id="CEP" name="CEP" value="<?php echo $cep; ?>" disabled>
  </div>
  <div class="form-group">
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" value="<?php echo $estado; ?>" disabled>
  </div>
  <div class="form-group button-group">
    <button id="alterarButton" type="button" onclick="habilitarCampos()">Alterar</button>
    <button id="confirmarButton" type="button" style="display: none;" onclick="enviarDados()">Confirmar</button>
  </div>
</form>

  </div>
</section>


  <footer>
    <p>Todos os direitos reservados &copy; 2023</p>
  </footer>

</body>

</html>
