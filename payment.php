<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Płatność - Sklep z Biletami</title>
    <link rel="stylesheet" href="styl.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>Płatność</h1>
    </header>

    <nav>
        <a href="main.php">Strona Główna</a>
        <a href="user.php">Panel Użytkownika</a>
        <a href="admin.php">Panel Administracyjny</a>
        <a href="help.php">Pomoc</a>
    </nav>

    <main>
        <div class="payment-container">
        <?php
            session_start();
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                header('Location: login.php');
                exit;
            }

            
            $db = new mysqli('localhost', 'root', '', 'ticket_store');

           
            $id_wydarzenia = isset($_GET['id_wydarzenia']) ? $db->real_escape_string($_GET['id_wydarzenia']) : null;

            
            if (!$id_wydarzenia) {
                header('Location: wydarzenia.php');
                exit;
            }

        
            $sql = "SELECT * FROM wydarzenia WHERE id = $id_wydarzenia";
            $result = $db->query($sql);

           
            if ($result && $result->num_rows > 0) {
                $wydarzenie = $result->fetch_assoc();
                echo "<table>";
                echo "<tr><th>Nazwa</th><td>" . $wydarzenie['nazwa'] . "</td></tr>";
                echo "<tr><th>Opis</th><td>" . $wydarzenie['opis'] . "</td></tr>";
                echo "<tr><th>Data</th><td>" . $wydarzenie['data'] . "</td></tr>";
                echo "<tr><th>Czas</th><td>" . $wydarzenie['czas'] . "</td></tr>";
                echo "<tr><th>Miejsce</th><td>" . $wydarzenie['miejsce'] . "</td></tr>";
                echo "<tr><th>Cena biletu</th><td>" . $wydarzenie['cena_biletu'] . " zł</td></tr>";
                echo "</table>";
            } else {
                echo "Nie znaleziono wydarzenia o podanym ID!";
            }
        ?>
            <h2>Dane Płatności</h2>
            <form action="buy_ticket.php" method="post" class="payment-form">
                <input type="hidden" name="id_wydarzenia" value="<?php echo $id_wydarzenia; ?>">
                <div class="form-group">
                    <label for="quantity">Ilość biletów:</label>
                    <input type="number" id="quantity" name="ilość" placeholder="Ilość biletów..." required>
                </div>
                <div class="form-group">
                    <label for="card-name">Nazwa na karcie:</label>
                    <input type="text" id="card-name" name="nazwa_karty" placeholder="Nazwa na karcie..." required>
                </div>
                <div class="form-group">
                    <label for="card-number">Numer karty:</label>
                    <input type="text" id="card-number" name="numer_karty" placeholder="Numer karty..." required>
                </div>
                <div class="form-group">
                    <label for="expiry-date">Data wygaśnięcia:</label>
                    <input type="text" id="expiry-date" name="data_wygaśnięcia" placeholder="Data wygaśnięcia..." required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" placeholder="CVV..." required>
                </div>
                <button type="submit" class="payment-button">Kup</button>
            </form>
        </div>
    </main>

    <footer>
        <h4>Mikołaj Szechniuk s30565</h4>
    </footer>
</body>
</html>
