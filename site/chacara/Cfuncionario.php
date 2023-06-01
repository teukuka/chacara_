<?php
// Configurações do banco de dados
$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "chacara"; // Nome do banco de dados
$table = "funcionario"; // Nome da tabela

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário de edição foi enviado
if (isset($_POST['save_button'])) {
    $edit_id = $_POST['edit_id'];
    $edit_nome = $_POST['edit_nome'];
    $edit_cpf = $_POST['edit_cpf'];
    $edit_telefone = $_POST['edit_telefone'];
    $edit_funcao = $_POST['edit_funcao'];
    $edit_salario = $_POST['edit_salario'];

    // Atualiza os dados no banco de dados
    $update_query = "UPDATE $table SET nome='$edit_nome', CPF='$edit_cpf', Telefone='$edit_telefone', funcao='$edit_funcao', salario='$edit_salario' WHERE id_funcionario='$edit_id'";
    $update_result = $conn->query($update_query);

    if ($update_result) {
        echo "Dados atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar os dados: " . $conn->error;
    }
}

// Verifica se o formulário de remoção foi enviado
if (isset($_POST['remove_button'])) {
    $remove_id = $_POST['remove_id'];

    // Remove os dados do banco de dados
    $remove_query = "DELETE FROM $table WHERE id_funcionario='$remove_id'";
    $remove_result = $conn->query($remove_query);

    if ($remove_result) {
        echo "Dados removidos com sucesso.";
    } else {
        echo "Erro ao remover os dados: " . $conn->error;
    }
}

// Query para recuperar os dados da tabela "funcionario"
$sql = "SELECT id_funcionario, nome, CPF, Telefone, funcao, salario FROM $table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Funcionário</title>
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
    <table id="example" class="table table-striped" style="width:100%" method="post">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Função</th>
                <th>Salário</th>
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
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["CPF"] . "</td>";
                    echo "<td>" . $row["Telefone"] . "</td>";
                    echo "<td>" . $row["funcao"] . "</td>";
                    echo "<td>" . $row["salario"] . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-primary' onclick='editEmployee(this)' data-id='" . $row["id_funcionario"] . "'>Alterar</button>";
                    echo "<button class='btn btn-danger' onclick='removeEmployee(this)' data-id='" . $row["id_funcionario"] . "'>Remover</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div id="edit_form" style="display: none;">
        <h3>Editar Funcionário</h3>
        <form method="post">
            <input type="hidden" id="edit_id" name="edit_id">
            <label>Nome:</label>
            <input type="text" id="edit_nome" name="edit_nome">
            <label>CPF:</label>
            <input type="text" id="edit_cpf" name="edit_cpf">
            <label>Telefone:</label>
            <input type="text" id="edit_telefone" name="edit_telefone">
            <label>Função:</label>
            <input type="text" id="edit_funcao" name="edit_funcao">
            <label>Salário:</label>
            <input type="text" id="edit_salario" name="edit_salario">
            <button type="submit" name="save_button">Salvar</button>
        </form>
    </div>

    <div id="remove_form" style="display: none;">
        <h3>Remover Funcionário</h3>
        <form method="post">
            <input type="hidden" id="remove_id" name="remove_id">
            <p>Deseja remover o funcionário?</p>
            <button type="submit" name="remove_button">Sim</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: true // Ativar campo de pesquisa
            });
        });

        function editEmployee(button) {
            var row = button.parentNode.parentNode;
            var id = button.getAttribute("data-id");
            var nome = row.cells[0].innerHTML;
            var cpf = row.cells[1].innerHTML;
            var telefone = row.cells[2].innerHTML;
            var funcao = row.cells[3].innerHTML;
            var salario = row.cells[4].innerHTML;

            document.getElementById("edit_id").value = id;
            document.getElementById("edit_nome").value = nome;
            document.getElementById("edit_cpf").value = cpf;
            document.getElementById("edit_telefone").value = telefone;
            document.getElementById("edit_funcao").value = funcao;
            document.getElementById("edit_salario").value = salario;

            document.getElementById("edit_form").style.display = "block";
        }

        function removeEmployee(button) {
            var id = button.getAttribute("data-id");
            document.getElementById("remove_id").value = id;
            document.getElementById("remove_form").style.display = "block";
        }
    </script>

    <footer>
        <p>Todos os direitos reservados &copy; 2023</p>
    </footer>

</body>

</html>
