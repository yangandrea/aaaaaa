<?php
session_start();
include "Connessione.php";

$sql = "SELECT * FROM Users WHERE username= 'admin' OR username= 'root'";
$result = $conn->query($sql);

$adminExists = $result->num_rows > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $adminExists) {
    $azione = $_POST['azione'];
    $id = $_POST['id'];
    $descrizione = $_POST['descrizione'];
    $prezzo = $_POST['prezzo'];

    if ($azione === 'aggiorna') {
        $sql = "UPDATE Products SET description='$descrizione', price=$prezzo WHERE id=$id";
        $conn->query($sql);
        echo 'Prodotto aggiornato.';
    } elseif ($azione === 'aggiungi') {
        $sql = "INSERT INTO Products (description, price) VALUES ('$descrizione', $prezzo)";
        $conn->query($sql);
        echo 'Prodotto aggiunto.';
    } elseif ($azione === 'elimina') {
        $sql = "DELETE FROM Products WHERE id=$id";
        $conn->query($sql);
        echo 'Prodotto eliminato.';
    }
}

$sql = "SELECT id, name, description, price FROM Products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pannello di Amministrazione</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-dark">
<header>
    <h1>Pannello di Amministrazione</h1>
</header>
<div style="float: left;text-align: left; padding-left: 10px;">
    <form action="logout.php" method="post">
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
</div>

<main>
    <div class="container">
        <?php if ($adminExists): ?>
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card bg-light">
                                <form method="post">
                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                    <label for="descrizione">Descrizione:</label>
                                    <input type="text" id="descrizione" name="descrizione" value="<?php echo $product['description']; ?>">
                                    <br>
                                    <label for="prezzo">Prezzo:</label>
                                    <input type="number" id="prezzo" name="prezzo" value="<?php echo $product['price']; ?>">
                                    <br>
                                    <label for="azione">Azione:</label>
                                    <select id="azione" name="azione">
                                        <option value="aggiorna">Aggiorna</option>
                                        <option value="elimina">Elimina</option>
                                    </select>
                                    <br>
                                    <input type="submit" value="Invia" style="color: black;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <form action="aggiunta.php">
                <button type="submit" class="btn btn-primary" name="aggiungi">Aggiungi</button>
            </form>
        <?php else: ?>
            <p>L'admin non esiste.</p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>