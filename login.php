<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie i Rejestracja - Sklep z Biletami</title>
    <link rel="stylesheet" href="styl.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>Logowanie i Rejestracja</h1>
    </header>
    <nav>
        <a href="main.php">Strona Główna</a>
        <a href="wydarzenia.php">Wydarzenia</a>
        <a href="admin.php">Panel Administracyjny</a>
        <a href="help.php">Pomoc</a>
    </nav>

    <main>
        <div class="form-container">
            <section class="login-section">
                <h2>Logowanie</h2>
                <form action="logowanie.php" method="post" class="login-form">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Email..." required>
                    </div>
                    <div class="form-group">
                        <label for="password">Hasło:</label>
                        <input type="password" id="password" name="hasło" placeholder="Hasło..." required>
                    </div>
                    <button type="submit" class="login-button">Zaloguj się</button>
                </form>
            </section>

            <section class="registration-section">
                <h2>Rejestracja</h2>
                <form action="rejestracja.php" method="post" class="registration-form">
                    <div class="form-group">
                        <label for="reg-email">Email:</label>
                        <input type="email" id="reg-email" name="email" placeholder="Email..." required>
                    </div>
                    <div class="form-group">
                        <label for="reg-password">Hasło:</label>
                        <input type="password" id="reg-password" name="hasło" placeholder="Hasło..." required>
                    </div>
                    <div class="form-group">
                        <label for="name">Imię:</label>
                        <input type="text" id="name" name="imię" placeholder="Imię..." required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Nazwisko:</label>
                        <input type="text" id="surname" name="nazwisko" placeholder="Nazwisko..." required>
                    </div>
                    <button type="submit" class="register-button">Zarejestruj się</button>
                </form>
            </section>
        </div>
    </main>

    <footer>
        <h4>Mikołaj Szechniuk s30565</h4>
    </footer>
</body>
</html>
