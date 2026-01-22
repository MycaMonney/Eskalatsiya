<?php
session_start();
require "db.php";

if (isset($_POST["signup"])) {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username && $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO utilisateur (username, mot_de_passe_hash)
                 VALUES (?, ?)"
            );
            $stmt->execute([$username, $hash]);

            // Redirection vers la page de connexion
            header("Location: login.php?signup=success");
            exit;
        } catch (PDOException $e) {
            $messageSignup = "Nom d'utilisateur déjà utilisé";
        }
    } else {
        $messageSignup = "Tous les champs sont obligatoires";
    }
}
