<?php

$db = new mysqli('localhost', 'root', '', 'ticket_store');


$email = $db->real_escape_string($_POST['email']);
$hasło = $db->real_escape_string($_POST['hasło']);


if ($email === 'admin@bilety.pl' && $hasło === 'admin') {

    session_start();
    $_SESSION['loggedinadmin'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['is_admin'] = true;
    header('Location: admin.php');
} else {
    echo "Nieprawidłowy email lub hasło!";
}

$db->close();
?>
