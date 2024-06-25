<?php
session_start();


if (!isset($_SESSION['loggedinadmin']) || $_SESSION['loggedinadmin'] !== true) {
    header('Location: admin_login.php');
    exit;
}


$db = new mysqli('localhost', 'root', '', 'ticket_store');


if (isset($_POST['ticket_id'])) {
    $ticket_id = $db->real_escape_string($_POST['ticket_id']);


    $sql = "DELETE FROM bilety WHERE id = $ticket_id";


    if ($db->query($sql)) {
        header('Location: admin.php');
        exit;
    } else {
        echo "Błąd podczas usuwania biletu: " . $db->error;
    }
} else {
    echo "Nie podano ID biletu.";
}

$db->close();
?>
