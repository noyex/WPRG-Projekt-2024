<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wydarzenia - Sklep z Biletami</title>
    <link rel="stylesheet" href="styl.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>Wydarzenia</h1>
    </header>

    <nav>
        <a href="main.php">Strona Główna</a>
        <a href="user.php">Panel Użytkownika</a>
        <a href="admin.php">Panel Administracyjny</a>
        <a href="help.php">Pomoc</a>
    </nav>

    <main>
        <h2>Wyszukaj Wydarzenie</h2>
        <form action="wydarzenia.php" method="get">
            <input type="text" name="search" placeholder="Wpisz nazwę wydarzenia...">
            <button type="submit">Szukaj</button>
        </form>

        <?php
     
        $db = new mysqli('localhost', 'root', '', 'ticket_store');
        if ($db->connect_error) {
            die("Nie można połączyć się z bazą danych: " . $db->connect_error);
        }

     
        $search = isset($_GET['search']) ? $db->real_escape_string($_GET['search']) : '';

       
        if ($search !== '') {
           
            $sql = "SELECT * FROM wydarzenia WHERE nazwa LIKE '%$search%'";
            $result = $db->query($sql);

           
            if ($result->num_rows > 0) {
                echo "<h2>Wyniki wyszukiwania</h2>";
                echo "<table>";
                echo "<tr><th>Nazwa</th><th>Opis</th><th>Data</th><th>Czas</th><th>Miejsce</th><th>Cena biletu</th><th>Akcja</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nazwa'] . "</td>";
                    echo "<td>" . $row['opis'] . "</td>";
                    echo "<td>" . $row['data'] . "</td>";
                    echo "<td>" . $row['czas'] . "</td>";
                    echo "<td>" . $row['miejsce'] . "</td>";
                    echo "<td>" . $row['cena_biletu'] . " zł</td>";
                    echo "<td><a href='payment.php?id_wydarzenia=" . $row['id'] . "'>Kup bilet</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Brak wyników dla podanego zapytania.</p>";
            }
        }

       
        echo "<h2>Wszystkie Wydarzenia</h2>";
        $sql = "SELECT * FROM wydarzenia";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Nazwa</th><th>Opis</th><th>Data</th><th>Czas</th><th>Miejsce</th><th>Cena biletu</th><th>Akcja</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nazwa'] . "</td>";
                echo "<td>" . $row['opis'] . "</td>";
                echo "<td>" . $row['data'] . "</td>";
                echo "<td>" . $row['czas'] . "</td>";
                echo "<td>" . $row['miejsce'] . "</td>";
                echo "<td>" . $row['cena_biletu'] . " zł</td>";
                echo "<td><a href='payment.php?id_wydarzenia=" . $row['id'] . "'>Kup bilet</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Brak wydarzeń do wyświetlenia.</p>";
        }
        $db->close();
        ?>

        <div class="image-gallery">
            <img src="pge.jpg" alt="pge narodowy">
            <img src="rock.jpg" alt="koncert rokowy">
            <img src="wystawa.jpeg" alt="koncert">
        </div>
    </main>

    <footer>
        <h4>Mikołaj Szechniuk s30565</h4>
    </footer>
</body>
</html>
