<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    die("Accès refusé. Veuillez vous connecter.");
}

if ($_SESSION["role"] != "admin") {
    die("Vous n'avez pas les droits nécessaires.");
}

echo "Bienvenue, " . $_SESSION["username"] . " (Admin)";
header('location: gestion.php')
?>
