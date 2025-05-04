<?php
require_once '../includes/config.php';

// Création de la table contact_messages
$query = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_read TINYINT(1) DEFAULT 0
)";

if ($conn->query($query)) {
    echo "Table contact_messages créée avec succès!";
} else {
    echo "Erreur lors de la création de la table: " . $conn->error;
}

$conn->close();
?> 