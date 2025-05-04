<?php
// Vérifier la connexion avant d'inclure le header
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté']);
    exit();
}

// Inclure uniquement la configuration de la base de données
require_once '../config/database.php';

// Définir le type de contenu JSON avant tout autre output
header('Content-Type: application/json');

try {
    // Vérifier si des cartes ont été tirées
    if (!isset($_SESSION['last_drawn_cards']) || empty($_SESSION['last_drawn_cards'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Aucune carte n\'a été tirée récemment'
        ]);
        exit();
    }

    // Retourner les cartes tirées
    echo json_encode([
        'success' => true,
        'cards' => $_SESSION['last_drawn_cards']
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?> 