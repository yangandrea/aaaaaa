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