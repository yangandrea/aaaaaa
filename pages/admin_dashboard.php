<?php
session_start();
include "Connessione.php";

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    echo 'Access denied.';
    exit;
}

$sql = "SELECT * FROM Users WHERE username= 'admin' OR username= 'root'";
$result = $conn->query($sql);

$adminExists = $result->num_rows > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $adminExists) {
    $action = $_POST['action'];
    $id = $_POST['id'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if ($action === 'update') {
        $sql = "UPDATE Products SET description='$description', price=$price WHERE id=$id";
        $conn->query($sql);
        echo 'Product updated.';
    } elseif ($action === 'add') {
        $sql = "INSERT INTO Products (description, price) VALUES ('$description', $price)";
        $conn->query($sql);
        echo 'Product added.';
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM Products WHERE id=$id";
        $conn->query($sql);
        echo 'Product deleted.';
    }
}

$sql = "SELECT id, name, description, price FROM Products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php if ($adminExists): ?>
    <?php while ($product = $result->fetch_assoc()): ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo $product['description']; ?>">
            <br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>">
            <br>
            <label for="action">Action:</label>
            <select id="action" name="action">
                <option value="update">Update</option>
                <option value="delete">Delete</option>
            </select>
            <br>
            <button type="submit">Submit</button>
        </form>

    <?php endwhile; ?>
    <form action="aggiunta.php">
        <button type="submit" class="btn btn-primary" name="add">Aggiungi</button>
    </form>
<?php else: ?>
    <p>Admin does not exist.</p>
<?php endif; ?>
</body>
</html>