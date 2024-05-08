<?php
session_start();
include "Connessione.php";

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    echo 'Access denied.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$description = $_POST['description'];
$price = $_POST['price'];

if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($image["name"]);

    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        echo "The image has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your image.";
    }
}
    $sql = "INSERT INTO Products (description, price, image) VALUES ('$description', $price, '$target_file')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label for="description">Description:</label>
    <input type="text" id="description" name="description">
    <br>
    <label for="price">Price:</label>
    <input type="number" id="price" name="price">
    <br>
    <label for="image">Image:</label>
    <input type="file" id="image" name="image">
    <br>
    <button type="submit">Add Product</button>
</form>