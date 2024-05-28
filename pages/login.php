<?php
include "Connessione.php";
session_start();

if (isset($_SESSION['username'])) {
    $_SESSION['cart'] = array();
    $sql = "SELECT CartItems.product_id, CartItems.count, Products.name, Products.description, Products.price, Products.immagine
            FROM CartItems
            INNER JOIN Products ON CartItems.product_id = Products.id
            WHERE CartItems.username = '{$_SESSION['username']}'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        $_SESSION['cart'][$product_id] = array(
            'count' => $row['count'],
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'immagine' => $row['immagine']
        );
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accedi</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-dark">
<header>
    <h1>Creative Creations</h1>
</header>
<main>
    <div class="container">
        <button><a href="../index.php">Pagina Principale</a></button>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <form method="post" action="login_handler.php">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username">
                            <br>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password">
                            <br>
                            <button type="submit">Accedi</button>
                        </form>
                        <button><a href="registrazione.php">Registrati</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    <p>&copy; 2024 Il nostro magico negozio online</p>
</footer>
</body>
</html>