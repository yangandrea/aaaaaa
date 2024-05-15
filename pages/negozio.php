<?php
session_start();
include "Connessione.php";
$sql = "SELECT id, name, description, price, immagine FROM Products";
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body class="bg-warning">
<button type="button"><a href="../index.php">login</a></button>
<button type="button"><a href="carello.php">carello</a></button>

<div class="container">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <form method="post">
                <h2><?php echo $product['name']; ?></h2>
                <img src="<?php echo $product['immagine']; ?>" alt="<?php echo $product['name']; ?>" style="width: 100px; height: 100px;">
                <p><?php echo $product['description']; ?></p>
                <p>Price: <?php echo $product['price']; ?></p>
                <input type="hidden" name="action" value="add_to_cart">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <button type="submit">Add to cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
