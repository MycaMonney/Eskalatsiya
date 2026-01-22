<?php
session_start();

// Protection de la page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>

    <h1>Bienvenue <?= htmlspecialchars($_SESSION["username"]) ?> 👋</h1>

    <a href="logout.php">Se déconnecter</a>

</body>

</html>