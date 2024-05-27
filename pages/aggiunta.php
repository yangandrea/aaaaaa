<?php
session_start();
include "Connessione.php";

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Acesso negato</title>
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
        Acesso negato.
    </body>
    </html>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $target_dir = "../images/";
        $target_file = $target_dir . basename($image["name"]);

        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            echo "L'immagine è stata caricata.";
        } else {
            echo "Spiacente, c'è stato un errore nel caricamento dell'immagine.";
        }
    }
    $sql = "INSERT INTO Products (name, description, price, immagine) VALUES ('$name', '$description', $price, '$target_file')";
    if ($conn->query($sql) === TRUE) {
        echo "Nuovo prodotto aggiunto con successo";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aggiungi Prodotto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-dark">
<header>
    <h1>Aggiungi Prodotto</h1>
</header>
<main>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name">
            <br>
            <label for="description">Descrizione:</label>
            <input type="text" id="description" name="description">
            <br>
            <label for="price">Prezzo:</label>
            <input type="number" id="price" name="price">
            <br>
            <label for="image">Immagine:</label>
            <input type="file" id="image" name="image">
            <br>
            <button type="submit">Aggiungi Prodotto</button>
        </form>
        <a href="../index.php" type="button">Ritorna alla Pagina Principale</a>
    </div>
</main>
<footer>
    <p>&copy; 2024 Il nostro magico negozio online</p>
</footer>
</body>
</html>