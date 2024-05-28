<?php
global $conn;
ini_set('session.cookie_lifetime', 24 * 60 * 60);
session_start();

include "Connessione.php";
if (isset($_SESSION['username']) && !isset($_SESSION['cart'])) {
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['emptyCart'])) {
        $sql = "DELETE FROM CartItems WHERE username = '{$_SESSION['username']}'";
        $conn->query($sql);
        $_SESSION['cart'] = array();
    } elseif (isset($_POST['removeProduct'])) {
        $product_id = $_POST['removeProduct'];
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['count'] -= 1;
            if ($_SESSION['cart'][$product_id]['count'] <= 0) {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    } elseif (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $sql = "SELECT * FROM Products WHERE id = $product_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['count'] += 1;
            } else {
                $product['count'] = 1;
                $_SESSION['cart'][$product_id] = $product;
            }
        }
    } elseif (isset($_POST['placeOrder'])) {
        $total = 0;
        foreach ($_SESSION['cart'] as $product_id => $product_details) {
            $total += $product_details['price'] * $product_details['count'];
        }
        $sql = "INSERT INTO Orders (username, total) VALUES ('{$_SESSION['username']}', $total)";
        $conn->query($sql);
        $_SESSION['cart'] = array();
    }
}
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $product_details) {
        $total += $product_details['price'] * $product_details['count'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Carrello</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .card {
            background-color: #f8f9fa;
        }
        .card-body {
            color: #000000;
        }
        .card-text {
            color: #000000;
        }
        .container {
            padding-bottom: 50px;
        }
        footer {
            margin-top: 50px;
        }

    </style>
</head>
<body class="bg-dark">
<header>
    <h1 style="color: #ffffff; text-align: center;">Carrello</h1>
</header>
<div id="homepageButton">
    <a href="../index.php" class="btn btn-primary">Homepage</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <?php foreach ($_SESSION['cart'] as $product_id => $product_details): ?>
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?php echo $product_details['immagine']; ?>" class="card-img" alt="<?php echo $product_details['name']; ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product_details['name']; ?></h5>
                                    <p class="card-text"><?php echo $product_details['description']; ?></p>
                                    <p class="card-text">Price: <?php echo $product_details['price']; ?></p>
                                    <p class="card-text">Quantity: <?php echo $product_details['count']; ?></p>
                                    <form method="post" action="carello.php">
                                        <input type="hidden" name="removeProduct" value="<?php echo $product_id; ?>">
                                        <button type="submit" id="bottoneCarrelloRimuovi" class="btn btn-danger" >Rimuovi una unità</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p id="emptyCartMessage">Nessun prodotto nel carrello.</p>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Totale</h5>
                    <p class="card-text">Totale: <?php echo number_format($total, 2); ?> €</p>
                    <form method="post" action="carello.php">
                        <button type="submit" id="bottoneCarrello" name="emptyCart" class="btn btn-primary" >Svuota carrello</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <p style="color: #ffffff; text-align: center;">&copy; 2024 Il nostro magico negozio online</p>
</footer>
</body>
</html>