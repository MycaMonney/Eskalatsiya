<?php
session_start();
require "db.php";

$messageLogin = "";

if (isset($_POST["login"])) {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $pdo->prepare(
        "SELECT username, mot_de_passe_hash
         FROM utilisateur
         WHERE username = ?"
    );
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["mot_de_passe_hash"])) {
        $_SESSION["username"] = $user["username"];
        header("Location: dashboard.php");
        exit;
    } else {
        $messageLogin = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="container">
        <h1>Connexion</h1>

        <?php if ($messageLogin): ?>
            <p class="message error"><?= htmlspecialchars($messageLogin) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="login">Se connecter</button>
        </form>

        <a href="signup.php">Créer un compte</a>
    </div>

</body>


</html>