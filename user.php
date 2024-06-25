<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Użytkownika - Sklep z Biletami</title>
    <link rel="stylesheet" href="styl.css">
    <script src="script.js"></script>
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header('Location: login.php');
            exit;
        }
    ?>
    <header>
        <h1>Panel Użytkownika</h1>
    </header>

    <nav>
        <a href="main.php">Strona Główna</a>
        <a href="wydarzenia.php">Wydarzenia</a>
        <a href="admin.php">Panel Administracyjny</a>
        <a href="help.php">Pomoc</a>
    </nav>

    <main>
        <div class="user-panel-container">
            <section class="user-details">
                <h2>Dane Użytkownika</h2>
                <p>Email: <?php echo $_SESSION['email']; ?></p>
                <p>Imię: <?php echo $_SESSION['imię']; ?></p>
                <p>Nazwisko: <?php echo $_SESSION['nazwisko']; ?></p>
            </section>
            
            <section class="purchase-history">
                <h2>Historia Zakupów</h2>
                <?php
                
                    $db = new mysqli('localhost', 'root', '', 'ticket_store');

                   
                    $id_użytkownika = $_SESSION['id'];

                    
                    $sql = "SELECT b.id AS id_biletu, t.kwota, t.status, t.data_transakcji, w.nazwa 
                            FROM transakcje t 
                            JOIN bilety b ON t.id_biletu = b.id 
                            JOIN wydarzenia w ON b.id_wydarzenia = w.id 
                            WHERE t.id_użytkownika = $id_użytkownika 
                            ORDER BY t.data_transakcji DESC";
                    $result = $db->query($sql);

               
                    echo "<table>";
                    echo "<tr><th>ID Biletu</th><th>Kwota</th><th>Status</th><th>Data Transakcji</th><th>Wydarzenie</th><th>Bilet</th></tr>";

            
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_biletu'] . "</td>";
                        echo "<td>" . $row['kwota'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['data_transakcji'] . "</td>";
                        echo "<td>" . $row['nazwa'] . "</td>";
                        echo "<td>";
                        if ($row['status'] == 'Zaakceptowano') {
                            echo "<a href='download.php?id_biletu=" . $row['id_biletu'] . "'>Pobierz bilet</a>";
                        } else {
                            echo "Bilet niedostępny";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }

                    // Zakończenie tabeli
                    echo "</table>";

                    $db->close();
                    ?>

            </section>
        </div>
        
        <form action="logout.php" method="post" class="logout-form">
            <button type="submit">Wyloguj się</button>
        </form>
    </main>

    <footer>
        <h4>Mikołaj Szechniuk s30565</h4>
    </footer>
</body>
</html>
