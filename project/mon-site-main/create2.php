<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "adalg");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyer et valider les entrées
    $titre = trim($_POST["titre"]);
    $date_parution = trim($_POST["date"]); // Date correcte
    $description = trim($_POST["description"]);
    $filiere = trim($_POST["type"]); // 'type' semble correspondre à 'filiere'

    // Valider les champs obligatoires
    if (empty($titre) || empty($date_parution) || empty($description) || empty($filiere)) {
        die("Tous les champs sont obligatoires.");
    }

    // Vérifier que la date est valide
    $date_format = DateTime::createFromFormat('Y-m-d', $date_parution);
    if (!$date_format) {
        die("Format de date invalide. Utilise AAAA-MM-JJ.");
    }

    // Insérer les données dans la base
    $stmt = $conn->prepare("INSERT INTO publications (titre, description, filiere, date_parution) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("ssss", $titre, $description, $filiere, $date_parution);

    if ($stmt->execute()) {
        echo "Publication ajoutée avec succès.";
        header("Location: Hub.php");
        exit(); // Arrêter le script après redirection
    } else {
        echo "Erreur lors de l'ajout de la publication : " . $stmt->error;
    }

    $stmt->close();
}

// Fermer la connexion à la base de données
$conn->close();
?>
