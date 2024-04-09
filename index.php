<?php
session_start();
include "pages/Connessione.php";
$sql = "SELECT id, name, description, price FROM Products";
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while($product = $result->fetch_assoc()) {
        $products[] = $product;
    }
} else {
    echo "No product found.";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['username'])) {
        $product_id = $_POST['product_id'];
        foreach ($products as $product) {
            if ($product['id'] == $product_id) {
                $_SESSION['cart'][$product_id] = $product;
                echo 'Adding to cart...';
                break;
            }
        }
    } else {
        echo 'You must be logged in to add items to your cart.';
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body class="bg-warning">
<button type="button"><a href="pages/registrazione.php">Register</a></button>
<button type="button"><a href="pages/login.php">login</a></button>
<button type="button"><a href="pages/admin.php">Admin</a></button>
<button type="button"><a href="pages/carello.php">carello</a></button>
<div class="container">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-sm">
                <img src="Images/prodotto1.jpg" class="img-fluid" alt="Responsive image">
                <h2><?php echo $product['name']; ?></h2>
                <p><?php echo $product['description']; ?></p>
                <p>Price: <?php echo $product['price']; ?></p>
                <form method="post" action="pages/carello.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="btn btn-primary" name="addToCart">Aggiungi al carrello</button>
                </form>
            </div>
    </div>
    <div class="col-sm">
        <img src="Images/prodotto2.jpg" class="img-fluid" alt="Responsive image">
        <h2><?php echo $product['name']; ?></h2>
        <p><?php echo $product['description']; ?></p>
        <p>Price: <?php echo $product['price']; ?></p>
        <form method="post" action="pages/carello.php">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <button type="submit" class="btn btn-primary" name="addToCart">Aggiungi al carrello</button>
        </form>
    </div>
</div>
<?php endforeach; ?>
</body>
</html>