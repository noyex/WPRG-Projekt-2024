<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie - Panel Administracyjny</title>
    <link rel="stylesheet" href="styl.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>Logowanie - Panel Administracyjny</h1>
    </header>
    <nav>
        <a href="main.php">Strona Główna</a>
        <a href="wydarzenia.php">Wydarzenia</a>
        <a href="user.php">Panel użytkownika</a>
        <a href="help.php">Pomoc</a>
    </nav>
    <main>
        <div class="login-container">
            <h2>Logowanie</h2>
            <form action="admin_logowanie.php" method="post" class="login-form">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Wpisz swój email" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="hasło" placeholder="Wpisz swoje hasło" required>
                </div>
                <button type="submit" class="login-button">Zaloguj się</button>
            </form>
        </div>
    </main>

    <footer>
        <h4>Mikołaj Szechniuk s30565</h4>
    </footer>
</body>
</html>
