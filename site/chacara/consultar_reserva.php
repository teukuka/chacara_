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
            <div class="reservation-item">
                <div class="reservation-details">
                    <h3>Reserva #1</h3>
                    <p>Data de Check-in: <span class="check-in-date">10/06/2023</span></p>
                    <p>Data de Check-out: <span class="check-out-date">12/06/2023</span></p>
                </div>
                <div class="reservation-actions">
                    <input type="date" class="new-check-in-date">
                    <button class="change-date-button">Alterar Data</button>
                    <button class="cancel-reservation-button">Cancelar Reserva</button>
                </div>
            </div>
            <div class="reservation-item">
                <div class="reservation-details">
                    <h3>Reserva #2</h3>
                    <p>Data de Check-in: <span class="check-in-date">15/06/2023</span></p>
                    <p>Data de Check-out: <span class="check-out-date">18/06/2023</span></p>
                </div>
                <div class="reservation-actions">
                    <input type="date" class="new-check-in-date">
                    <button class="change-date-button">Alterar Data</button>
                    <button class="cancel-reservation-button">Cancelar Reserva</button>
                </div>
            </div>
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
