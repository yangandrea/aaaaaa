<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Qui dovresti verificare le credenziali dell'utente nel tuo database
    // Per semplicità, in questo esempio, supponiamo che le credenziali siano corrette

    $_SESSION['username'] = $username;

    if ($username === 'admin') {
        header('Location: admin_dashboard.php');
    } else {
        header('Location: negozio.php');
    }
}
?>