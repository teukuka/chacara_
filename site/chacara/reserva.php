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
            <h2>Valor por dia: R$ 1250</h2>
            <div class="form-group">
                <label for="check-in">Check-in:</label>
                <input type="date" id="check-in" name="check-in" required>
            </div>
            <div class="form-group">
                <label for="check-out">Check-out:</label>
                <input type="date" id="check-out" name="check-out" required>
            </div>
            <div class="form-group">
                <label for="cozinheira">Deseja cozinheira(almoço e janta): 500 reais</label>
                  <div class="radio-group">
                    <input type="radio" id="cozinheira-sim" name="cozinheira" value="sim" required>
                    <label for="cozinheira-sim">Sim</label>
                    <input type="radio" id="cozinheira-nao" name="cozinheira" value="nao">
                    <label for="cozinheira-nao">Não</label>
                </div>
            </div>
            <div class="form-group">
                <label for="cafe-da-manha">Café da Manhã Incluso: 200 reais</label>
                <div class="radio-group">
                    <input type="radio" id="cafe-da-manha-sim" name="cafe-da-manha" value="sim" required>
                    <label for="cafe-da-manha-sim">Sim</label>
                    <input type="radio" id="cafe-da-manha-nao" name="cafe-da-manha" value="nao">
                    <label for="cafe-da-manha-nao">Não</label>
                </div>
            </div>
            <div class="form-group">
                 <a href="pagamento.php" class="reserve-button">Reservar Agora</a>
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
