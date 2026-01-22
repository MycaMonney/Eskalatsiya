<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="container">

        <h1>Inscription</h1>

        <?php if (!empty($messageSignup)): ?>
            <p class="message error"><?= htmlspecialchars($messageSignup) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="signup">S'inscrire</button>
        </form>

        <a href="login.php">Déjà un compte ?</a>

    </div>

</body>


</html>