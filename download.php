<?php
session_start();


$db = new mysqli('localhost', 'root', '', 'ticket_store');


$id_biletu = isset($_GET['id_biletu']) ? $db->real_escape_string($_GET['id_biletu']) : null;
$id_uzytkownika = $_SESSION['id'];


$sql = "SELECT b.id, w.nazwa, b.ilość, b.data_zakupu, t.status FROM bilety b 
        JOIN wydarzenia w ON b.id_wydarzenia = w.id 
        JOIN transakcje t ON b.id = t.id_biletu 
        WHERE b.id = $id_biletu AND b.id_użytkownika = $id_uzytkownika";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $bilet = $result->fetch_assoc();


    if ($bilet['status'] == 'Zaakceptowano') {
       
        $content = 'ID Biletu: ' . $bilet['id'] . "\n" . 
                   'Nazwa Wydarzenia: ' . $bilet['nazwa'] . "\n" . 
                   'Ilość Biletów: ' . $bilet['ilość'] . "\n" . 
                   'Data Zakupu: ' . $bilet['data_zakupu'] . "\n\n";


        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="bilet_' . $bilet['id'] . '.txt"');
        header('Content-Length: ' . strlen($content));

    
        echo $content;
    } else {
        echo "Transakcja nie została zaakceptowana - bilet nie może zostać pobrany.";
    }
} else {
    echo "Nie znaleziono biletu o podanym ID lub nie masz uprawnień do pobrania tego biletu!";
}

$db->close();
?>
