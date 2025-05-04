<?php
require_once 'config.php';

try {
    // Création de la table contact_messages
    $query = "CREATE TABLE IF NOT EXISTS contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        is_read BOOLEAN DEFAULT FALSE
    )";
    
    $conn->exec($query);
    echo "Table contact_messages créée avec succès ou déjà existante.";
} catch(PDOException $e) {
    echo "Erreur lors de la création de la table: " . $e->getMessage();
} 