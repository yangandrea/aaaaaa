<?php
include "Connessione.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $idCategoria = $_POST['idCategoria'];

    $immagine = $_FILES['immagine']['name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["immagine"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if(in_array($imageFileType,$extensions_arr) ){
        // Upload file
        if(move_uploaded_file($_FILES['immagine']['tmp_name'],$target_file)){
            // Save the relative path of the image in the database
            $sql = "INSERT INTO Products (name, description, price, immagine, idCategoria) VALUES ('$name', '$description', $price, '$target_file', $idCategoria)";
            $conn->query($sql);
            echo 'Prodotto aggiunto.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aggiungi Prodotto</title>
</head>
<body>
<form action="aggiunta.php" method="post" enctype="multipart/form-data">
    <label for="name">Nome:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="description">Descrizione:</label><br>
    <textarea id="description" name="description"></textarea><br>
    <label for="price">Prezzo:</label><br>
    <input type="number" id="price" name="price" step="0.01"><br>
    <label for="idCategoria">ID Categoria:</label><br>
    <input type="number" id="idCategoria" name="idCategoria"><br>
    <label for="immagine">Immagine:</label><br>
    <input type="file" id="immagine" name="immagine"><br>
    <input type="submit" value="Aggiungi Prodotto">
</form>
<a href="admin_dashboard.php" class="btn btn-primary">Torna alla Dashboard</a>
</body>
</html>