<?php
session_start();
include "pages/Connessione.php";
$result = $conn->query('SELECT * FROM Categories');
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="css/style.css">
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
        <h1>Creative Creations</h1>
    </header>

    <div style="border: 1px solid white">
        <nav>
            <ul>
                <li style="border: 1px solid white;"><a href="pages/carello.php">Carrello</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li style="border: 1px solid white;"><a href="pages/logout.php">Logout</a></li>';
                } else {
                    echo '<li style="border: 1px solid white;"><a href="pages/login.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>

    <main>
        <div class="container">
            <div class="row">
                <?php
                // Crea una colonna per ciascun prodotto
                while ($row = $result->fetch_assoc())
                {
                    echo '<div class="col-sm-4">';
                    echo '<div class="card bg-light">';
                    echo '<a href="pages/category.php?id=' . $row['id'] . '">';
                    echo '<img src="' . $row['immagine'] . '" class="card-img-top img-fluid" alt="' . $row['name'] . '">';
                    echo '</a>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
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

    <div id="cookie-popup" class="cookie-popup">
        <p>Questo sito utilizza i cookie per garantire la migliore esperienza di navigazione possibile. <a href="policy.html">Scopri di più</a>.</p>
        <button id="accept-cookies" class="accept-cookies">Accetta</button>
    </div>

    <script>
        window.onload = function() {
            // Mostra il pop-up quando la pagina viene caricata
            document.getElementById('cookie-popup').style.display = 'block';

            // Nasconde il pop-up quando l'utente accetta i cookie
            document.getElementById('accept-cookies').onclick = function() {
                document.getElementById('cookie-popup').style.display = 'none';
            };
        };
    </script>
    </body>
</html>
<?php
$conn->close();
?>