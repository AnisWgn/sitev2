<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: Page_De_Connexion.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="Styles/styles.css">
</head>
<body>
    <?php
    echo "<h1>Bienvenue, " . htmlspecialchars($_SESSION['username']) . " !</h1>";
    echo "<p>Vous êtes maintenant connecté a votro cocomaison.</p>";
    ?>

    <h2>Que souhaitez-vous faire ?</h2>
    <ul>
        <li><a href="option_profile.php">Paramètres</a></li>
        <li><a href="Hub.php">🔍 Rechercher un stage</a></li>
        <li><a href="index.html">Page d'accueil</a></li>
        <li><a href="change_mot_passe.php">change mot passe</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</body>
</html>