
<!DOCTYPE html>
<html>

<head>
  <title>Gerenciamento</title>
  <link rel="stylesheet" type="text/css" href="style7.css">
</head>

<body>
  <header>
    <div class="logo">
            <img src="logo.png" alt="Codeware">
            <span>Chacará Codeware</span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Sair</a></li>
            </ul>
        </nav>
  </header>

  <section class="management-section">
    <div class="container">
      <h2>Gerenciamento</h2>
      <div class="button-group">
          <button onclick="cadastrarFuncionario()">Cadastrar Funcionário</button>
          <button onclick="consultarReservas()">Consultar Reservas</button>
          <button onclick="consultarFuncionarios()">Consultar Funcionários</button>
          <button onclick="consultarUsuarios()">Consultar Usuarios</button>
          <button onclick="consultarGasto()">Consultar/Adicionar Gasto</button>
          <button onclick="gerarRelatorios()">Relatórios</button>
      </div>
    </div>
  </section>

  <footer>
     <div class="footer-bottom">
        <p>&copy; 2023 Codeware.com Todos os direitos reservados.</p>
    </div>
  </footer>

</body>

</html>


<script>
  function cadastrarFuncionario() {
    window.location.href = "funcionario.php";
  }

  function consultarReservas() {
    window.location.href = "Creserva.php";
  }

  function consultarFuncionarios() {
    window.location.href = "Cfuncionario.php";
  }

  function consultarGasto() {
    window.location.href = "Cgastos.php"
  }

  function gerarRelatorios() {
    window.location.href = "relatorio.php";
  }
  function consultarUsuarios(){
    window.location.href = "Cusuario.php";
  }
</script>