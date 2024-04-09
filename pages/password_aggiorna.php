<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Per favore inserisci un indirizzo email valido.';
        exit;
    }

    $token = bin2hex(random_bytes(50));

    $sql = "UPDATE Users SET reset_token='$token' WHERE email='$email'";
    $conn->query($sql);

    $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
    $message = "Per reimpostare la tua password, clicca sul seguente link: $reset_link";
    mail($email, "Reimposta la tua password", $message);

    echo 'Ti abbiamo inviato un email con le istruzioni per reimpostare la tua password.';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<form method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <br>
    <button type="submit">Reset Password</button>
</form>
</body>
</html>