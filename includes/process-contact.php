<?php
header('Content-Type: application/json');
require_once __DIR__ . '/config.php';

// Activer l'affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialiser la réponse
$response = ['success' => false, 'message' => ''];

// Log de débogage
error_log('Début du traitement du formulaire de contact');

// Vérifier la connexion à la base de données
if (!$conn) {
    $response['message'] = 'Erreur de connexion à la base de données. Vérifiez la configuration.';
    error_log('Erreur de connexion à la base de données');
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log('Données POST reçues: ' . print_r($_POST, true));
    
    // Récupérer et valider les données
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);

    error_log("Données validées - Nom: $name, Email: $email, Sujet: $subject");

    // Vérifier que tous les champs sont remplis
    if (!$name || !$email || !$message || !$subject) {
        $response['message'] = 'Veuillez remplir tous les champs.';
        error_log('Champs manquants dans le formulaire');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Veuillez entrer une adresse email valide.';
        error_log('Email invalide: ' . $email);
    } else {
        try {
            // Vérifier si la table existe
            $tableExists = $conn->query("SHOW TABLES LIKE 'contact_messages'")->rowCount() > 0;
            error_log('Table contact_messages existe: ' . ($tableExists ? 'oui' : 'non'));
            
            if (!$tableExists) {
                error_log('Création de la table contact_messages');
                // Créer la table si elle n'existe pas
                $conn->exec("CREATE TABLE contact_messages (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    subject VARCHAR(255) NOT NULL,
                    message TEXT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    is_read BOOLEAN DEFAULT FALSE
                )");
            } else {
                // Vérifier si la colonne 'subject' existe
                $columns = $conn->query("SHOW COLUMNS FROM contact_messages")->fetchAll(PDO::FETCH_COLUMN);
                if (!in_array('subject', $columns)) {
                    error_log('Ajout de la colonne subject');
                    $conn->exec("ALTER TABLE contact_messages ADD COLUMN subject VARCHAR(255) NOT NULL AFTER email");
                }
            }

            // Préparer et exécuter la requête d'insertion
            $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
            $stmt = $conn->prepare($query);
            
            // Binder les paramètres avec bindValue
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
            $stmt->bindValue(':message', $message, PDO::PARAM_STR);
            
            error_log('Exécution de la requête d\'insertion');
            // Exécuter la requête
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Message envoyé avec succès!';
                error_log('Message inséré avec succès');
            } else {
                $errorInfo = $stmt->errorInfo();
                $response['message'] = 'Erreur lors de l\'exécution de la requête: ' . $errorInfo[2];
                error_log('Erreur d\'exécution: ' . print_r($errorInfo, true));
            }
        } catch(PDOException $e) {
            $response['message'] = 'Erreur PDO: ' . $e->getMessage();
            error_log('Erreur PDO: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
} else {
    $response['message'] = 'Méthode de requête non autorisée.';
    error_log('Méthode de requête non autorisée: ' . $_SERVER['REQUEST_METHOD']);
}

// Ajouter des informations de débogage
$response['debug'] = [
    'post_data' => $_POST,
    'error_info' => isset($stmt) ? $stmt->errorInfo() : null,
    'connection_status' => $conn ? 'Connected' : 'Not connected'
];

error_log('Réponse finale: ' . json_encode($response));
echo json_encode($response); 