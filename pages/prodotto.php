<?php
session_start();
include "Connessione.php";

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT Products.*, Categories.name as categoryName FROM Products
            INNER JOIN Categories ON Products.idCategoria = Categories.id
            WHERE Products.id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $error = "Nessun prodotto trovato con l'ID specificato.";
    }
} else {
    $error = "Nessun ID prodotto specificato.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Prodotto</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        body {
            background-color: #343a40;
        }
        header {
            text-align: center;
            color: #ffffff;
            padding: 20px 0;
        }
        footer {
            text-align: center;
            color: #ffffff;
            padding: 20px 0;
        }
        .container-body {
        }
    </style>
</head>
<body class="bg-dark">
<header>
    <h1>Creative Creations</h1>
</header>

<main>
    <?php if (isset($product)): ?>
        <div class="container bg-light">
            <div class="row">
                <div class="col-sm-6">
                    <a href="category.php?id=<?php echo $product['id']; ?>">
                        <img src="<?php echo $product['immagine']; ?>" class="img-fluid" alt="<?php echo $product['name']; ?>">
                    </a>
                </div>
                <div class="col-sm-6">
                    <div class="container-body">
                        <h5 class="container-title"><?php echo $product['name']; ?></h5>
                        <p>Descrizione: <?php echo $product['description']; ?></p>
                        <p>Prezzo: <?php echo $product['price']; ?></p>
                        <p>Categoria: <?php echo $product['categoryName']; ?></p>
                        <form method="post" action="carello.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" id="bottoneCarrello" class="btn btn-primary">Aggiungi al carello</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</main>
<footer>
    <p>&copy; 2024 Il nostro magico negozio online</p>
</footer>
</body>
</html>