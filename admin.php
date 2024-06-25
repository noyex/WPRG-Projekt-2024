<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administracyjny - Sklep z Biletami</title>
    <link rel="stylesheet" href="styl1.css">
    <script src="script.js"></script>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['loggedinadmin']) || $_SESSION['loggedinadmin'] !== true) {
        header('Location: admin_login.php');
        exit;
    }
    ?>
    <header>
        <h1>Panel Administracyjny</h1>
    </header>

    <nav>
        <a href="main.php">Strona Główna</a>
        <a href="wydarzenia.php">Wydarzenia</a>
        <a href="user.php">Panel Użytkownika</a>
        <a href="help.php">Pomoc</a>
    </nav>

    <main>
        <div class="form-container">
            <section>
                <h2>Zarządzanie Wydarzeniami</h2>
                <form action="add_event.php" method="post">
                    <h3>Dodaj nowe wydarzenie</h3>
                    <input type="text" name="nazwa" placeholder="Nazwa wydarzenia...">
                    <input type="text" name="opis" placeholder="Opis wydarzenia...">
                    <input type="date" name="data" placeholder="Data wydarzenia...">
                    <input type="time" name="czas" placeholder="Czas wydarzenia...">
                    <input type="text" name="miejsce" placeholder="Miejsce wydarzenia...">
                    <input type="number" step="0.01" name="cena_biletu" placeholder="Cena biletu...">
                    <button type="submit">Dodaj Wydarzenie</button>
                </form>
                
                <form action="delete_event.php" method="post">
                    <h3>Usuń wydarzenie</h3>
                    <input type="number" name="id" placeholder="ID wydarzenia...">
                    <button type="submit">Usuń Wydarzenie</button>
                </form>
            </section>

            <section>
                <h2>Zarządzanie Użytkownikami</h2>
                <form action="delete_user.php" method="post">
                    <input type="number" name="user_id" placeholder="Id użytkownika" required>
                    <button type="submit">Usuń użytkownika</button>
                </form>
                <?php
         
            $db = new mysqli('localhost', 'root', '', 'ticket_store');


            $sql = "SELECT u.id, u.email, u.imię, u.nazwisko, COUNT(b.id) AS ilość_biletów 
                    FROM użytkownicy u
                    LEFT JOIN bilety b ON u.id = b.id_użytkownika
                    GROUP BY u.id";

            $result = $db->query($sql);

           
            echo "<table>";
            echo "<tr><th>ID Użytkownika</th><th>Email</th><th>Imię</th><th>Nazwisko</th><th>Ilość Biletów</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['imię'] . "</td>";
                echo "<td>" . $row['nazwisko'] . "</td>";
                echo "<td>" . $row['ilość_biletów'] . "</td>"; 
                echo "</tr>";
            }

      
            echo "</table>";

            $db->close();
            ?>
            </section>

            <section>
                <h2>Zarządzanie Transakcjami</h2>
                <form action="transaction_update.php" method="post">
                    <input type="number" name="transaction_id" placeholder="ID transakcji...">
                    <select name="transaction_status">
                        <option value="Zaakceptowano">Zaakceptowano</option>
                        <option value="Anulowano">Anulowano</option>
                    </select>
                    <button type="submit">Zarządzaj Transakcją</button>
                </form>
                <?php
   
            $db = new mysqli('localhost', 'root', '', 'ticket_store');

      
            $sql = "SELECT * FROM transakcje";
            $result = $db->query($sql);


            echo "<table>";
            echo "<tr><th>ID Transakcji</th><th>ID Użytkownika</th><th>ID Biletu</th><th>Kwota</th><th>Status</th><th>Data Transakcji</th></tr>";

    
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['id_użytkownika'] . "</td>";
                echo "<td>" . $row['id_biletu'] . "</td>";
                echo "<td>" . $row['kwota'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['data_transakcji'] . "</td>";
                echo "</tr>";
            }


            echo "</table>";

            $db->close();
            ?>
            </section>

            <section>
                <h2>Zarządzanie Biletami</h2>
                <form action="add_ticket.php" method="post">
                    <input type="number" name="user_id" placeholder="ID użytkownika" required>
                    <input type="number" name="event_id" placeholder="ID wydarzenia" required>
                    <input type="number" name="quantity" placeholder="Ilość biletów" required>
                    <button type="submit">Dodaj Bilet</button>
                </form>

                <form action="delete_ticket.php" method="post">
                    <input type="number" name="ticket_id" placeholder="ID biletu" required>
                    <button type="submit">Usuń Bilet</button>
                </form>
                <form action="logout.php" method="post">
                    <button type="submit">Wyloguj się</button>
                </form>
                <?php
                
                    $db = new mysqli('localhost', 'root', '', 'ticket_store');

                
                    $sql = "SELECT b.id, u.email, b.ilość, w.nazwa 
                            FROM bilety b
                            JOIN użytkownicy u ON b.id_użytkownika = u.id
                            JOIN wydarzenia w ON b.id_wydarzenia = w.id";

                    $result = $db->query($sql);

                
                    echo "<h2>Informacje o Biletach</h2>";
                    echo "<table>";
                    echo "<tr><th>ID Biletu</th><th>Email Użytkownika</th><th>Ilość Biletów</th><th>Nazwa Wydarzenia</th></tr>";

                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['ilość'] . "</td>";
                        echo "<td>" . $row['nazwa'] . "</td>";
                        echo "</tr>";
                    }

                  
                    echo "</table>";9

                   
                    ?>
            </section>
        </div>
    </main>

    <footer>
        <h4>Mikołaj Szechniuk s30565</h4>
    </footer>
</body>
</html>
