<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' or $username === 'root') {
        $_SESSION['admin'] = true;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo 'Invalid admin credentials.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin Login</title>
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
</form>
</body>
</html>