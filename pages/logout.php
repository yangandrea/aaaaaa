<?php
include "Connessione.php";
session_start();

if (isset($_SESSION['username'])) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $product_details) {
            $count = $product_details['count'];
            $sql = "INSERT INTO CartItems (username, product_id, count)
                    VALUES ('{$_SESSION['username']}', $product_id, $count)
                    ON DUPLICATE KEY UPDATE count = $count";
            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    $_SESSION['cart'] = array();
}


session_destroy();
header('Location: ../index.php');
exit;
?>