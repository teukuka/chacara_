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

// Consultar as reservas do usuário logado
$sql = "SELECT * FROM reserva WHERE usuario_id = '$idUsuario'";
$result = $conn->query($sql);
$reservas = array();

$contador = 1; // Inicializa o contador

if ($result->num_rows > 0) {
    // Loop através das reservas e armazenar os dados em um array
    while ($row = $result->fetch_assoc()) {
        $reserva = array(
            'contador' => $contador,
            'id' => $row['id_reserva'],
            'checkin' => $row['checkin'],
            'checkout' => $row['checkout']
        );
        $reservas[] = $reserva;

        $contador++; // Incrementa o contador
    }
}

// Função para recalcular o valor total da reserva
function calcularValorTotal($checkin, $checkout, $cozinheira, $cafeDaManha)
{
    $valor = 1250;

    // Calcular o número de dias
    $diffTime = strtotime($checkout) - strtotime($checkin);
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

    return $valorTotal;
}

// Processar o formulário de alteração de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o formulário de alteração de reserva foi enviado
    if (isset($_POST["reserva_id"]) && isset($_POST["checkin"]) && isset($_POST["checkout"])) {
        // Obter os dados do formulário
        $reservaId = $_POST["reserva_id"];
        $novoCheckin = $_POST["checkin"];
        $novoCheckout = $_POST["checkout"];

        // Recalcular o valor total da reserva
        $valorTotal = calcularValorTotal($novoCheckin, $novoCheckout, $_POST["cozinheira"], $_POST["cafe_da_manha"]);

        // Atualizar a reserva no banco de dados
        $updateSql = "UPDATE reserva SET checkin = '$novoCheckin', checkout = '$novoCheckout', valor = '$valorTotal' WHERE id_reserva = '$reservaId'";
        $conn->query($updateSql);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o formulário de cancelamento de reserva foi enviado
    if (isset($_POST["reserva_id"])) {
        // Obter o ID da reserva a ser cancelada
        $reservaId = $_POST["reserva_id"];

        // Excluir a reserva do banco de dados
        $deleteSql = "DELETE FROM reserva WHERE id_reserva = '$reservaId'";
        $conn->query($deleteSql);

        // Redirecionar para a página atual
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Minhas Reservas - Codeware</title>
    <link rel="stylesheet" href="style4.css">
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

    <section class="reservation-section">
        <h2>Minhas Reservas</h2>
        <div class="reservation-list">
            <?php if (count($reservas) > 0) : ?>
                <?php foreach ($reservas as $reserva) : ?>
                    <div class="reservation-item">
                        <div class="reservation-details">
                            <h3>Reserva #<?php echo $reserva['contador']; ?></h3>
                            <p>Data de Check-in: <span class="check-in-date"><?php echo $reserva['checkin']; ?></span></p>
                            <p>Data de Check-out: <span class="check-out-date"><?php echo $reserva['checkout']; ?></span></p>
                        </div>
                        <div class="reservation-actions">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
        <label for="checkin">Novo Check-in:</label>
        <input type="date" name="checkin" required>
        <label for="checkout">Novo Check-out:</label>
        <input type="date" name="checkout" required>
        <label for="cozinheira">Cozinheira:</label>
        <select name="cozinheira">
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
        </select>
        <label for="cafe_da_manha">Café da Manhã:</label>
        <select name="cafe_da_manha">
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
        </select>
        <button type="submit">Alterar Reserva</button>
    </form>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
        <button type="submit" class="cancel-reservation-button" onclick="return confirm('Tem certeza de que deseja cancelar esta reserva?')">Cancelar Reserva</button>
    </form>
</div>

                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Nenhuma reserva encontrada.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2023 Codeware.com Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>
