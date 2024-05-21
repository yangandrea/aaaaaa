<?php
session_start();
include "Connessione.php";

// Recupera l'ID della categoria dall'URL
$idCategoria = $_GET['id'];

// Esegui una query SQL per ottenere i prodotti per la categoria specificata
$result = $conn->query("SELECT * FROM Products WHERE idCategoria = $idCategoria");
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Category Page</title>
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
        <h1>Category Page</h1>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <?php
                // Crea una colonna per ciascun prodotto
                while ($row = $result->fetch_assoc())
                {
                    echo '<div class="col-sm-4">';
                    echo '<div class="card bg-light">';
                    echo '<img src="' . $row['immagine'] . '" class="card-img-top img-fluid" alt="' . $row['name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '<p class="card-text">' . $row['description'] . '</p>';
                    echo '<p class="card-text">' . $row['price'] . '</p>';
                    echo '<form action="carello.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                    echo '<button type="submit" id="bottoneCarrello" class="btn btn-primary">Add to cart</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                }
                ?>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Il nostro magico negozio online</p>
    </footer>
    </body>
    </html>
<?php
$conn->close();
?>