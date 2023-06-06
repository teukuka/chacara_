<?php
// Configurações do banco de dados
$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "chacara"; // Nome do banco de dados
$table = "gasto"; // Nome da tabela

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário de edição foi enviado
if (isset($_POST['save_button'])) {
    $edit_id = $_POST['edit_id'];
    $edit_mes = $_POST['edit_mes'];
    $edit_valor = $_POST['edit_valor'];
    $edit_descricao = $_POST['edit_descricao'];

    // Atualiza os dados no banco de dados
    $update_query = "UPDATE $table SET mes='$edit_mes', valor='$edit_valor', descricao='$edit_descricao' WHERE id_gasto='$edit_id'";
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
    $remove_query = "DELETE FROM $table WHERE id_gasto='$remove_id'";
    $remove_result = $conn->query($remove_query);

    if ($remove_result) {
        echo "Dados removidos com sucesso.";
    } else {
        echo "Erro ao remover os dados: " . $conn->error;
    }
}

if (isset($_POST['create_button'])) {
    $create_mes = $_POST['create_mes'];
    $create_valor = $_POST['create_valor'];
    $create_descricao = $_POST['create_descricao'];

    // Insere os dados no banco de dados
    $create_query = "INSERT INTO $table (mes, valor, descricao) VALUES ('$create_mes', '$create_valor', '$create_descricao')";
    $create_result = $conn->query($create_query);

    if ($create_result) {
        echo "Gasto criado com sucesso.";
    } else {
        echo "Erro ao criar o gasto: " . $conn->error;
    }
}

// Query para recuperar os dados da tabela "gasto"
$sql = "SELECT id_gasto, mes, valor, descricao FROM $table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrar Gasto</title>
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
                <th>Mês</th>
                <th>Valor</th>
                <th>Descrição</th>
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
                    echo "<td>" . $row["mes"] . "</td>";
                    echo "<td>" . $row["valor"] . "</td>";
                    echo "<td>" . $row["descricao"] . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-primary' onclick='editGasto(this)' data-id='" . $row["id_gasto"] . "'>Alterar</button>";
                    echo "<button class='btn btn-danger' onclick='removeGasto(this)' data-id='" . $row["id_gasto"] . "'>Remover</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum registro encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div id="edit_form" style="display: none;">
        <h3>Editar Gasto</h3>
        <form method="post">
            <input type="hidden" id="edit_id" name="edit_id">
            <label>Mês:</label>
            <input type="text" id="edit_mes" name="edit_mes">
            <label>Valor:</label>
            <input type="text" id="edit_valor" name="edit_valor">
            <label>Descrição:</label>
            <input type="text" id="edit_descricao" name="edit_descricao">
            <button type="submit" name="save_button">Salvar</button>
        </form>
    </div>

    <div id="remove_form" style="display: none;">
        <h3>Remover Gasto</h3>
        <form method="post">
            <input type="hidden" id="remove_id" name="remove_id">
            <p>Deseja remover o gasto?</p>
            <button type="submit" name="remove_button">Sim</button>
        </form>
    </div>

    <div id="create_form" style="display: none;">
        <h3>Registrar Gasto</h3>
        <form method="post">
            <label>Mês:</label>
            <input type="text" id="create_mes" name="create_mes">
            <label>Valor:</label>
            <input type="text" id="create_valor" name="create_valor">
            <label>Descrição:</label>
            <input type="text" id="create_descricao" name="create_descricao">
            <button type="submit" name="create_button">Adicionar</button>
        </form>
    </div>

    <button class="btn btn-primary" onclick="showCreateForm()">Adicionar Gasto</button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: true // Ativar campo de pesquisa
            });
        });

        function editGasto(button) {
            var row = button.parentNode.parentNode;
            var id = button.getAttribute("data-id");
            var mes = row.cells[0].innerHTML;
            var valor = row.cells[1].innerHTML;
            var descricao = row.cells[2].innerHTML;

            document.getElementById("edit_id").value = id;
            document.getElementById("edit_mes").value = mes;
            document.getElementById("edit_valor").value = valor;
            document.getElementById("edit_descricao").value = descricao;

            document.getElementById("edit_form").style.display = "block";
        }

        function removeGasto(button) {
            var id = button.getAttribute("data-id");
            document.getElementById("remove_id").value = id;
            document.getElementById("remove_form").style.display = "block";
        }

        function showCreateForm() {
            document.getElementById("create_form").style.display = "block";
        }
    </script>
</body>

</html>
