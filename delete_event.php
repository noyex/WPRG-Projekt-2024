<?php

$db = new mysqli('localhost', 'root', '', 'ticket_store');



$id = $db->real_escape_string($_POST['id']);


$sql = "DELETE FROM wydarzenia WHERE id = $id";


if ($db->query($sql) === TRUE) {
    header('Location: admin.php');
    exit;
} else {
    echo "Błąd: " . $db->error;
}

$db->close();
?>
