<?php

$db = new mysqli('localhost', 'root', '', 'ticket_store');


$transaction_id = $db->real_escape_string($_POST['transaction_id']);
$transaction_status = $db->real_escape_string($_POST['transaction_status']);


if ($transaction_status != 'Zaakceptowano' && $transaction_status != 'Anulowano') {
    die('Błąd: Nieprawidłowy status transakcji');
}


$sql = "UPDATE transakcje SET status = '$transaction_status' WHERE id = $transaction_id";


if ($db->query($sql) === TRUE) {
    header('Location: admin.php');
    exit;
} else {
    echo "Błąd: " . $db->error;
}

$db->close();
?>
