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