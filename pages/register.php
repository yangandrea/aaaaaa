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
        echo "La data di nascita è superiore alla data corrente.";
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;
        echo "<br><a href='registrazione.php'>Torna alla registrazione</a>";
        exit;
    }

    if (strlen($password) < 8) {
        echo "La password deve contenere almeno 8 caratteri.";
        echo "<br><a href='registrazione.php'>Torna alla registrazione</a>";
        exit;
    }
}

$sql = "SELECT * FROM Users WHERE username= '$username' OR email= '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Username or email already in use";
} else {
    $sql = "INSERT INTO Users (username, password, email, birthdate) VALUES ('$username', '$password', '$email', '$birthdate')";

    if($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        $_SESSION['username'] = $username;
        echo "User registered successfully";
    }
}
?>
<br>
<a href='../index.php'>Home</a>
<a href='admin.php'>Login as Admin</a>
<a href="login.php">fai l'accesso</a>
<a href="edit_profile.php">modifica il tuo profilo</a>
<a href="login.php">fai l'accesso</a>
