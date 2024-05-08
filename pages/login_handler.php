<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparare la query SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Eseguire la query
    $stmt->execute();

    // Ottenere i risultati
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificare se l'utente esiste e la password è corretta
    if ($user && password_verify($password, $user['password'])) {
        // Login riuscito, impostare l'username in sessione e reindirizzare l'utente
        $_SESSION['username'] = $username;

        if ($username === 'admin') {
            header('Location: admin_dashboard.php');
        } else {
            header('Location: negozio.php');
        }
    } else {
        echo 'Login failed, setting error message';
        header('Location: ../index.php');
    }
}