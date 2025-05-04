<?php
session_start(); // Démarre la session

$conn = new mysqli("localhost", "root", "", "adalg");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Récupérer l'utilisateur depuis la base de données
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // Vérifier le mot de passe
    if ($result && password_verify($password, $result["password"])) {
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["username"] = $result["username"];
        $_SESSION["role"] = $result["role"];
        echo "Connexion réussie !";
        header('location: option_profile.php');
    } else {
        echo "Identifiants incorrects.";
    }
}
?>
