<?php

$db = new mysqli('localhost', 'root', '', 'ticket_store');


$email = $db->real_escape_string($_POST['email']);
$hasło = $db->real_escape_string($_POST['hasło']);

$sql = "SELECT * FROM użytkownicy WHERE email = '$email'";
$result = $db->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();
    if (password_verify($hasło, $user['hasło'])) {
     
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $user['id']; 
        $_SESSION['email'] = $email;
        $_SESSION['imię'] = $user['imię'];
        $_SESSION['nazwisko'] = $user['nazwisko']; 
        header('Location: user.php');
    } else {
        echo "Nieprawidłowe hasło!";
    }
} else {
    echo "Nieprawidłowy email!";
}

$db->close();
?>
