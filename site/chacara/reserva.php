<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chacara";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Redirecionar para a página de login
    header("Location: login.php");
    exit();
}

// Obter o ID do usuário da sessão
$idUsuario = $_SESSION['id_usuario'];

// Verificar se o formulário de reserva foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os valores do formulário
    $checkIn = $_POST['check-in'];
    $checkOut = $_POST['check-out'];
    $cozinheira = $_POST['cozinheira'];
    $cafeDaManha = $_POST['cafe-da-manha'];

    // Calcular o valor base por dia
    $valor = 1250;

    // Calcular o número de dias
    $diffTime = strtotime($checkOut) - strtotime($checkIn);
    $diffDays = ceil($diffTime / (60 * 60 * 24));

    // Calcular o valor total da reserva
    $valorTotal = $valor * $diffDays;

    // Adicionar o valor da cozinheira, se selecionado
    if ($cozinheira === "sim") {
        $valorTotal += 500;
    }

    // Adicionar o valor do café da manhã, se selecionado
    if ($cafeDaManha === "sim") {
        $valorTotal += 200;
    }

    // Inserir a reserva no banco de dados
    $sql = "INSERT INTO reserva (usuario_id, checkin, checkout, cozinheiro, cafe, valor) VALUES ('$idUsuario', '$checkIn', '$checkOut', '$cozinheira', '$cafeDaManha', '$valorTotal')";

    if ($conn->query($sql) === TRUE) {
    // Reserva adicionada com sucesso
    $lastReservaId = $conn->insert_id;
    $datasReservadas = getDatesBetween($checkIn, $checkOut);

    foreach ($datasReservadas as $data) {
        $sql = "INSERT INTO calendario (datas, evento, reserva_id) VALUES ('$data', 'reserva', '$lastReservaId')";
        $conn->query($sql);
    }

    $conn->close();
    header("Location: pagamento.php"); // Redirecionar para a página de pagamento
    exit();
} else {
    echo "Erro ao adicionar reserva: " . $conn->error;
}
}

function getDatesBetween($startDate, $endDate) {
    $dates = array($startDate);

    while (end($dates) < $endDate) {
        $dates[] = date('Y-m-d', strtotime(end($dates) . ' +1 day'));
    }

    return $dates;
}

function isDateReserved($date) {
    global $conn;

    $sql = "SELECT * FROM calendario WHERE datas = '$date'";
    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

// Verificar se as datas estão reservadas
$today = date('Y-m-d');
$disabledDates = array();
$sql = "SELECT datas FROM calendario WHERE datas >= '$today'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $disabledDates[] = $row['datas'];
    }
}
$disabledDatesJSON = json_encode($disabledDates);

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Codeware - Site de Hotéis</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Codeware">
            <span>Chácara Codeware</span>
        </div>
        <nav>
            <ul>
                <li><a href="dados_pessoal.php">Dados Pessoais</a></li>
                <li><a href="newindex.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <section class="reservation-section">
        <div class="container">
            <img src="entrada1.jpeg" alt="Chácara Codeware">
            <h2 id="valor-dia">Valor por dia: R$ 1250</h2>
            <form method="post">
            <div class="form-group">
                <label for="check-in">Check-in:</label>
                <input type="date" id="check-in" name="check-in" oninput="atualizarValorDia()" required>
            </div>
            <div class="form-group">
                <label for="check-out">Check-out:</label>
                <input type="date" id="check-out" name="check-out" oninput="atualizarValorDia()" required>
            </div>
            <div class="form-group">
                <label for="cozinheira">Deseja cozinheira (almoço e janta): 500 reais</label>
                <div class="radio-group">
                    <input type="radio" id="cozinheira-sim" name="cozinheira" value="sim" onchange="atualizarValorDia()" required>
                    <label for="cozinheira-sim">Sim</label>
                    <input type="radio" id="cozinheira-nao" name="cozinheira" value="nao" onchange="atualizarValorDia()">
                    <label for="cozinheira-nao">Não</label>
                </div>
            </div>
            <div class="form-group">
                <label for="cafe-da-manha">Café da Manhã Incluso: 200 reais</label>
                <div class="radio-group">
                    <input type="radio" id="cafe-da-manha-sim" name="cafe-da-manha" value="sim" onchange="atualizarValorDia()" required>
                    <label for="cafe-da-manha-sim">Sim</label>
                    <input type="radio" id="cafe-da-manha-nao" name="cafe-da-manha" value="nao" onchange="atualizarValorDia()">
                    <label for="cafe-da-manha-nao">Não</label>
                </div>
            </div>
            <div class="form-group">
                <button class="reserve-button">Reservar Agora</a>
            </div>
        </form>
        </div>
    </section>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2023 Codeware.com Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        function atualizarValorDia() {
            var valorDia = 1250; // Valor base por dia
            var checkIn = document.getElementById("check-in").value;
            var checkOut = document.getElementById("check-out").value;

            if (checkIn && checkOut) {
                var diffTime = Math.abs(new Date(checkOut) - new Date(checkIn));
                var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                var valorTotal = valorDia * diffDays;

                // Verifica se o café da manhã foi selecionado
                if (document.getElementById("cafe-da-manha-sim").checked) {
                    valorTotal += 200; // Adiciona o valor do café da manhã
                }

                // Verifica se a cozinheira foi selecionada
                if (document.getElementById("cozinheira-sim").checked) {
                    valorTotal += 500; // Adiciona o valor da cozinheira
                }

                document.getElementById("valor-dia").innerHTML = "Valor total: R$ " + valorTotal;
            }
        }

        var disabledDates = <?php echo $disabledDatesJSON; ?>;
        var today = new Date().toISOString().split('T')[0];
        var checkinInput = document.getElementById("check-in");
        var checkoutInput = document.getElementById("check-out");

        checkinInput.addEventListener("change", function () {
            var selectedDate = this.value;
            checkoutInput.min = selectedDate;

            if (selectedDate > checkoutInput.value || disabledDates.includes(selectedDate)) {
                checkoutInput.value = selectedDate;
            }
        });

        checkoutInput.addEventListener("change", function () {
            var selectedDate = this.value;
            checkinInput.max = selectedDate;

            if (selectedDate < checkinInput.value || disabledDates.includes(selectedDate)) {
                checkinInput.value = selectedDate;
            }
        });

        checkinInput.min = today;
        checkoutInput.min = today;
    </script>
</body>

</html>
