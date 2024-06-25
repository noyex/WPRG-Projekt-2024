<?php

$db = new mysqli('localhost', 'root', '', 'ticket_store');


$email = $db->real_escape_string($_POST['email']);
$hasło = $db->real_escape_string($_POST['hasło']);
$imię = $db->real_escape_string($_POST['imię']);
$nazwisko = $db->real_escape_string($_POST['nazwisko']);


$hasło_hash = password_hash($hasło, PASSWORD_DEFAULT);


$sql = "INSERT INTO użytkownicy (email, hasło, imię, nazwisko) VALUES ('$email', '$hasło_hash', '$imię', '$nazwisko')";


if ($db->query($sql) === TRUE) {

    header('Location: login.php');
} else {
    echo "Błąd: " . $db->error;
}

$db->close();
?>
