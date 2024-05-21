<?php
include "Connessione.php";

// Recupero l'ID del prodotto dal parametro GET
$id_prodotto = $_GET['id'];

// Preparo la query SQL per recuperare i dettagli del prodotto
$stmt = $conn->prepare('SELECT * FROM prodotti WHERE id = ?');
$stmt->execute([$id_prodotto]);
$prodotto = $stmt->fetch();

// Controllo se il prodotto esiste
if (!$prodotto) {
    die('Prodotto non trovato');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dettaglio Prodotto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1><?php echo htmlspecialchars($prodotto['nome']); ?></h1>
<p><?php echo htmlspecialchars($prodotto['descrizione']); ?></p>
<p>Prezzo: <?php echo htmlspecialchars($prodotto['prezzo']); ?>€</p>
<img src="<?php echo htmlspecialchars($prodotto['immagine']); ?>" alt="Immagine del prodotto">
</body>
</html>