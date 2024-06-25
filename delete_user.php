<?php
session_start();


if (!isset($_SESSION['loggedinadmin']) || $_SESSION['loggedinadmin'] !== true) {
    header('Location: admin_login.php');
    exit;
}


$db = new mysqli('localhost', 'root', '', 'ticket_store');


if (isset($_POST['user_id'])) {
    $user_id = $db->real_escape_string($_POST['user_id']);


    $sql = "DELETE FROM użytkownicy WHERE id = $user_id";


    if ($db->query($sql)) {

        header('Location: admin.php');
        exit;
    } else {
        echo "Błąd podczas usuwania użytkownika: " . $db->error;
    }
} else {
    echo "Nie podano ID użytkownika.";
}

$db->close();
?>
