<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin') {
        $sql = "SELECT username, password FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            $password = trim($password);
            $user['password'] = trim($user['password']);

            if ($password === $user['password']) {
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = true;
                header('Location: admin_dashboard.php');
            } else {
                echo 'Accesso fallito, la password non corrisponde';
            }
        } else {
            echo 'Accesso fallito, utente non esistente';
        }
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['admin'] = false;
        header('Location: ../index.php');
    }
}