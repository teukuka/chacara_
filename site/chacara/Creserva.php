<?php
// Configurações do banco de dados
$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "chacara"; // Nome do banco de dados
$table = "reserva"; // Nome da tabela
$users_table = "usuario"; // Nome da tabela de usuários

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário de edição foi enviado
if (isset($_POST['save_button'])) {
    $edit_id = $_POST['edit_id'];
    $edit_checkin = $_POST['edit_checkin'];
    $edit_checkout = $_POST['edit_checkout'];

    // Atualiza os dados no banco de dados
    $update_query = "UPDATE $table SET checkin='$edit_checkin', checkout='$edit_checkout' WHERE id_reserva='$edit_id'";
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
    $remove_query = "DELETE FROM $table WHERE id_reserva='$remove_id'";
    $remove_result = $conn->query($remove_query);

    if ($remove_result) {
        echo "Dados removidos com sucesso.";
    } else {
        echo "Erro ao remover os dados: " . $conn->error;
    }
}

// Query para recuperar os dados da tabela "reserva"
$sql = "SELECT r.id_reserva, r.checkin, r.checkout, u.usuario, u.email FROM $table r JOIN $users_table u ON r.usuario_id = u.id_usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cadastrar Reserva</title>
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
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Nome</th>
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
                    echo "<td>" . $row["checkin"] . "</td>";
                    echo "<td>" . $row["checkout"] . "</td>";
                    echo "<td>" . $row["usuario"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-primary' onclick='editReservation(this)' data-id='" . $row["id_reserva"] . "'>Alterar</button>";
                    echo "<button class='btn btn-danger' onclick='removeReservation(this)' data-id='" . $row["id_reserva"] . "'>Remover</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum registro encontrado</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div id="edit_form" style="display: none;">
        <h3>Editar Reserva</h3>
        <form method="post">
            <input type="hidden" id="edit_id" name="edit_id">
            <label>Check-in:</label>
            <input type="text" id="edit_checkin" name="edit_checkin">
            <label>Check-out:</label>
            <input type="text" id="edit_checkout" name="edit_checkout">
            <button type="submit" name="save_button">Salvar</button>
        </form>
    </div>

    <div id="remove_form" style="display: none;">
        <h3>Remover Reserva</h3>
        <form method="post">
            <input type="hidden" id="remove_id" name="remove_id">
            <p>Deseja remover a reserva?</p>
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

        function editReservation(button) {
            var row = button.parentNode.parentNode;
            var id = button.getAttribute("data-id");
            var checkin = row.cells[0].innerHTML;
            var checkout = row.cells[1].innerHTML;

            document.getElementById("edit_id").value = id;
            document.getElementById("edit_checkin").value = checkin;
            document.getElementById("edit_checkout").value = checkout;

            document.getElementById("edit_form").style.display = "block";
        }

        function removeReservation(button) {
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
