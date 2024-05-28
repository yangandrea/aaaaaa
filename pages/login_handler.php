<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['id']; // Aggiungi questa linea
        if ($username === 'admin') {
            header('Location: admin_dashboard.php');
        } else {
            header('Location: ../index.php');
        }
    } else {
        echo '<style>body {background-color: red;font-size: 3em;color: white;text-align: center;padding-top: 20%;}</style>';
        echo '<div><h1>Credenziali sbagliate.</h1> <h3><a href="login.php" style="color: white;">Torna al login</a></h3></div>';
    }
}
?>