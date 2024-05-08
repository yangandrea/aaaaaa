

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<form method="post" action="pages/login_handler.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <br>
    <button type="submit">Login</button>
    <br>
    <a href="pages/password_aggiorna.php">Password dimenticata</a>
    <a href="pages/registrazione.php">Registrati</a>
    <a href="pages/negozio.php">Guarda i nostri prodotti</a>
</form>
</body>
</html>