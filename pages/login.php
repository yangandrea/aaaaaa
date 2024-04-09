<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' || $username === 'root') {
        header('Location: admin.php');
        exit;
    }

    $sql = "SELECT * FROM Users WHERE username= '$username' AND password= '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
        exit;
    } else {
        echo 'Invalid credentials.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br>
    <button type="submit">Login</button>
    <br>
    <a href="password_aggiorna.php">reimposta passowrd</a>
    <a href="registrazione.php">Registrazione</a>
</form>
</body>
</html>