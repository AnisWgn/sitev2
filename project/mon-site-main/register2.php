<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "adalg");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["prof-name"]);
    $email = trim($_POST["email"]);
    $etablissement = trim($_POST["Etablissement"]);
    $password = $_POST["password"];

    // Valider les champs obligatoires
    if (empty($username) || empty($email) || empty($etablissement) || empty($password)) {
        die("Tous les champs sont obligatoires.");
    }

    // Valider l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("L'email n'est pas valide.");
    }

    // Hachage du mot de passe
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si l'email existe déjà
    $stmt = $conn->prepare("SELECT id FROM prof WHERE email = ?");
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Cet email est déjà utilisé.";
        $stmt->close();
    } else {
        // Insérer l'utilisateur dans la base de données
        $stmt = $conn->prepare("INSERT INTO prof (nom, email, établissement, mot_de_passe) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }
        $stmt->bind_param("ssss", $username, $email, $etablissement, $password_hashed);

        if ($stmt->execute()) {
            echo "Compte créé avec succès.";
            // Redirection vers la page de connexion
            header("Location: Page_De_Connexion.php");
            exit(); // Arrêter l'exécution du script après la redirection
        } else {
            echo "Erreur lors de la création du compte : " . $stmt->error;
        }
        $stmt->close();

        
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>