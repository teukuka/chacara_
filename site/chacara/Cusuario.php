<?php
// Configurações do banco de dados
$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "chacara"; // Nome do banco de dados
$table = "usuario"; // Nome da tabela
$id_column = "id_usuario"; // Nome da coluna de ID

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário de remoção foi enviado
if (isset($_POST['remove_button'])) {
    $remove_id = $_POST['remove_id'];

    // Remove os dados do banco de dados
    $remove_query = "DELETE FROM $table WHERE $id_column='$remove_id'";
    $remove_result = $conn->query($remove_query);

    if ($remove_result) {
        echo "Dados removidos com sucesso.";
    } else {
        echo "Erro ao remover os dados: " . $conn->error;
    }
}

// Query para recuperar os dados da tabela "usuario"
$sql = "SELECT $id_column, usuario, email FROM $table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" type="text/css" href="style8.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Codeware">
            <span>Chácara Codeware</span>
        </div>
        <nav>
            <ul>
                <li><a href="admin.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verifica se há registros retornados da consulta
            if ($result->num_rows > 0) {
                // Loop pelos registros e preenchimento das linhas da tabela
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["usuario"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>";
                    echo "<form method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='remove_id' value='" . $row[$id_column] . "'>";
                    echo "<button class='btn btn-danger' type='submit' name='remove_button'>Remover</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum registro encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: true // Ativar campo de pesquisa
            });
        });
    </script>

    <footer>
        <p>Todos os direitos reservados &copy; 2023</p>
    </footer>

</body>

</html>
