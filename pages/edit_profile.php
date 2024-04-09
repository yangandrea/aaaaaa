<?php
session_start();
include "Connessione.php";

if (!isset($_SESSION['username'])) {
    echo 'You must be logged in to edit your profile.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $new_email = $_POST['email'];
    $new_username = $_POST['username'];

    $sql = "UPDATE Users SET email='$new_email', username='$new_username' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        echo 'Profile updated.';
        $_SESSION['username'] = $new_username;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$username = $_SESSION['username'];
$sql = "SELECT email, username FROM Users WHERE username='$username'";
$result = $conn->query($sql);
if ($result === false) {
    die("Error: " . $conn->error);
}
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<form method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>">
    <br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>">
    <br>
    <button type="submit">Update</button>
</form>
</body>
</html>