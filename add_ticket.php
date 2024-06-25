<?php
session_start();


if (!isset($_SESSION['loggedinadmin']) || $_SESSION['loggedinadmin'] !== true) {
    header('Location: admin_login.php');
    exit;
}


$db = new mysqli('localhost', 'root', '', 'ticket_store');


if (isset($_POST['user_id'], $_POST['event_id'], $_POST['quantity'])) {
    $user_id = $db->real_escape_string($_POST['user_id']);
    $event_id = $db->real_escape_string($_POST['event_id']);
    $quantity = $db->real_escape_string($_POST['quantity']);


    $sql = "INSERT INTO bilety (id_użytkownika, id_wydarzenia, ilość) VALUES ('$user_id', '$event_id', '$quantity')";


    if ($db->query($sql)) {
        header('Location: admin.php');
        exit;
    } else {
        echo "Błąd podczas dodawania biletu: " . $db->error;
    }
} else {
    echo "Nie podano wszystkich danych.";
}

$db->close();
?>
