<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Strona Główna - Sklep z Biletami</title>
    <link rel="stylesheet" href="styl.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>Witaj w Sklepie z Biletami!</h1>
    </header>

    <nav>
        <a href="wydarzenia.php">Wydarzenia</a>
        <a href="user.php">Panel Użytkownika</a>
        <a href="admin.php">Panel Administracyjny</a>
        <a href="help.php">Pomoc</a>
    </nav>

    <main>
        <h2>Najnowsze Wydarzenia</h2>
        <?php
            $polaczenie = mysqli_connect('localhost', 'root', '', 'ticket_store');
            $zapytanie = "SELECT * FROM wydarzenia ORDER BY data DESC LIMIT 3";
            $wynik = mysqli_query($polaczenie, $zapytanie);

            echo "<table>";
            echo "<tr><th>Nazwa</th><th>Opis</th><th>Data</th><th>Czas</th><th>Miejsce</th><th>Cena biletu</th></tr>";

            while ($row = $wynik->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nazwa'] . "</td>";
                echo "<td>" . $row['opis'] . "</td>";
                echo "<td>" . $row['data'] . "</td>";
                echo "<td>" . $row['czas'] . "</td>";
                echo "<td>" . $row['miejsce'] . "</td>";
                echo "<td>" . $row['cena_biletu'] . " zł</td>";
                echo "</tr>";
            }

            echo "</table>";

            mysqli_close($polaczenie);
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
