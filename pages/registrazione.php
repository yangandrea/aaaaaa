<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<div id="paginaDiRegistrazione">
    <form action="register.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" placeholder="inserisci un nome utente" required oninvalid="this.setCustomValidity('Inserisci il tuo nome utente')"
               oninput="this.setCustomValidity('')" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
        <br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" placeholder="inserisci una password" required minlength="8" oninvalid="this.setCustomValidity('Inserisci una password valida di almeno 8 caratteri')"
               oninput="this.setCustomValidity('')" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>">
        <br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="inserisci una mail" required oninvalid="this.setCustomValidity('Inserisci un email valida')"
               oninput="this.setCustomValidity('')" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
        <br>
        <label for="birthdate">Birthdate:</label><br>
        <input type="date" id="birthdate" name="birthdate" placeholder="inserisci la data" required oninvalid="this.setCustomValidity('Inserisci una data valida')"
               oninput="this.setCustomValidity('')" >
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>