<?php
session_start();
include "Connessione.php";
$idCategoria = $_GET['id'];
$result = $conn->query("SELECT * FROM Products WHERE idCategoria = $idCategoria");
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Pagina Categoria</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <style>
            .card-img-top {
                width: 100%;
                height: 200px;
                object-fit: cover;
            }
            .button-container {
                position: absolute;
                top: 0;
                left: 0;
                margin-top: 78px; /* Aggiungi un margine superiore ai bottoni */
            }
        </style>
    </head>
    <body class="bg-dark">
    <header>
        <h1>Pagina Categoria</h1>
        <div class="button-container">
            <?php if (isset($_SESSION['username'])): ?>
                <form action="logout.php" method="post">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <?php
                while ($row = $result->fetch_assoc())
                {
                    echo '<div class="col-sm-4">';
                    echo '<div class="card bg-light">';
                    echo '<a href="prodotto.php?id=' . $row['id'] . '">';
                    echo '<img src="' . $row['immagine'] . '" class="card-img-top img-fluid" alt="' . $row['name'] . '">';
                    echo '</a>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '<p class="card-text">' . $row['description'] . '</p>';
                    echo '<p class="card-text">' . $row['price'] . '</p>';
                    echo '<form action="carello.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                    echo '<button type="submit" id="bottoneCarrello" class="btn btn-primary" ';
                    if (!isset($_SESSION['username'])) echo 'hidden';
                    echo '>Aggiungi al carrello</button>';
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