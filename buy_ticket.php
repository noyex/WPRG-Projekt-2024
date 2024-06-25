<?php
session_start();


$db = new mysqli('localhost', 'root', '', 'ticket_store');


$id_wydarzenia = $db->real_escape_string($_POST['id_wydarzenia']);
$ilość = $db->real_escape_string($_POST['ilość']);


$id_użytkownika = $_SESSION['id'];


$sql = "SELECT cena_biletu FROM wydarzenia WHERE id = $id_wydarzenia";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$cena_biletu = $row['cena_biletu'];


$kwota = $ilość * $cena_biletu;


$sql = "INSERT INTO bilety (id_wydarzenia, id_użytkownika, ilość, data_zakupu) VALUES ('$id_wydarzenia', '$id_użytkownika', '$ilość', CURDATE())";


if ($db->query($sql) === TRUE) {

    $id_biletu = $db->insert_id;


    $sql = "INSERT INTO transakcje (id_użytkownika, id_biletu, kwota, status, data_transakcji) VALUES ('$id_użytkownika', '$id_biletu', '$kwota', 'Oczekujące', CURDATE())";

  
    if ($db->query($sql) === TRUE) {
        header('Location: user.php');
    } else {
        echo "Błąd: " . $db->error;
    }
} else {
    echo "Błąd: " . $db->error;
}

$db->close();
?>
