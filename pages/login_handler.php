<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Se l'username è 'admin'
    if ($username === 'admin') {
        // Eseguire la query SQL
        $sql = "SELECT username, password FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        // Ottenere i risultati
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            $password = trim($password);
            $user['password'] = trim($user['password']);

            if ($password === $user['password']) {
                // Login riuscito, impostare l'username in sessione e reindirizzare l'utente
                $_SESSION['username'] = $username;
                header('Location: admin_dashboard.php');
            } else {
                echo 'Login failed, password does not match';
            }
        } else {
            echo 'Login failed, no such user';
        }
    } else {
        $_SESSION['username'] = $username;
        header('Location: negozio.php');
    }
}