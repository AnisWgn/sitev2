<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: Page_De_Connexion.php");
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adalg";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérez le nom d'utilisateur de la session
$username = $_SESSION['username'];

// Requête pour vérifier si l'utilisateur appartient à la table spécifique
$sql = "SELECT * FROM entreprises WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Si l'utilisateur n'est pas dans la table spécifique, redirigez-le
if ($result->num_rows == 0) {
    header("Location: Page_De_Connexion.php");
    exit();
}

// Fermez la connexion
$stmt->close();
$conn->close();

// Si l'utilisateur est dans la table spécifique, continuez à afficher la page
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="icon" type="image/x-icon" href="image/logo.png">
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