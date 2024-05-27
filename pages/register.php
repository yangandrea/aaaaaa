<?php
session_start();
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];

    $birthdateTimestamp = strtotime($birthdate);
    $Timestamp = strtotime(date("Y-m-d"));

    if ($birthdateTimestamp > $Timestamp) {
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Error</title>
            <style>
                body {
                    background-color: red;
                    font-size: 3em;
                    color: white;
                    text-align: center;
                    padding-top: 20%;
                }
            </style>
        </head>
        <body>
            La data di nascita è superiore alla data corrente.
        </body>
        </html>';
        exit;
    }
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username or email already in use";
        header('Location: registrazione.php');
        exit;
    } else {
        $sql = "INSERT INTO Users (username, password, email, birthdate) VALUES ('$username', '$password', '$email', '$birthdate')";

        if($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } else {
            $_SESSION['username'] = $username;
            echo "User registered successfully";
        }
    }
    header('Location: ../index.php');
}
?>
<br>