<?php
session_start();

// Vide toutes les variables de session
$_SESSION = [];

// Détruit la session
session_destroy();

// Redirection vers login
header("Location: login.php");
exit;
