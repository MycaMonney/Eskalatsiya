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
        // Sauvegarde en session
        $_SESSION["username"] = $user["username"];

        // Redirection
        header("Location: dashboard.php");
        exit;
    } else {
        $messageLogin = "Identifiants incorrects";
    }
}
