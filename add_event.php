<?php

$db = new mysqli('localhost', 'root', '', 'ticket_store');


$nazwa = $db->real_escape_string($_POST['nazwa']);
$opis = $db->real_escape_string($_POST['opis']);
$data = $db->real_escape_string($_POST['data']);
$czas = $db->real_escape_string($_POST['czas']);
$miejsce = $db->real_escape_string($_POST['miejsce']);
$cena_biletu = $db->real_escape_string($_POST['cena_biletu']);

$sql = "INSERT INTO wydarzenia (nazwa, opis, data, czas, miejsce, cena_biletu) VALUES ('$nazwa', '$opis', '$data', '$czas', '$miejsce', '$cena_biletu')";

if ($db->query($sql) === TRUE) {
    header('Location: admin.php');
    exit;
} else {
    echo "Błąd: " . $db->error;
}

$db->close();
?>
