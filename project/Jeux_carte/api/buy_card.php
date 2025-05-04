<?php
// Vérifier la connexion avant d'inclure le header
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté pour acheter des cartes']);
    exit();
}

// Inclure uniquement la configuration de la base de données
require_once '../config/database.php';

// Désactiver l'affichage des erreurs HTML
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Définir le type de contenu JSON avant tout autre output
header('Content-Type: application/json');

try {
    // Récupérer les données JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $cardId = $data['card_id'] ?? null;

    if (!$cardId) {
        throw new Exception('ID de carte manquant');
    }

    // Récupérer les informations de la carte
    $query = "SELECT id, name, price, available_for_purchase FROM cards WHERE id = ? AND available_for_purchase = 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$cardId]);
    $card = $stmt->fetch();

    if (!$card) {
        throw new Exception('Carte non disponible');
    }

    // Récupérer le solde actuel de l'utilisateur
    $stmt = $pdo->prepare("SELECT coins FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        throw new Exception('Utilisateur non trouvé');
    }

    // Vérifier si l'utilisateur a assez de pièces
    if ($user['coins'] < $card['price']) {
        throw new Exception('Solde insuffisant');
    }

    // Démarrer la transaction
    $pdo->beginTransaction();

    try {
        // Ajouter la carte à la collection de l'utilisateur
        $stmt = $pdo->prepare("INSERT INTO user_cards (user_id, card_id, quantity) 
                              VALUES (?, ?, 1) 
                              ON DUPLICATE KEY UPDATE quantity = quantity + 1");
        $stmt->execute([$_SESSION['user_id'], $cardId]);

        // Déduire le prix de la carte du solde de l'utilisateur
        $stmt = $pdo->prepare("UPDATE users SET coins = coins - ? WHERE id = ?");
        $stmt->execute([$card['price'], $_SESSION['user_id']]);

        // Mettre à jour le solde dans la session
        $_SESSION['coins'] = $user['coins'] - $card['price'];

        // Valider la transaction
        $pdo->commit();

        echo json_encode([
            'success' => true, 
            'message' => 'Achat réussi !',
            'price' => $card['price'],
            'newBalance' => $_SESSION['coins']
        ]);

    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $pdo->rollBack();
        throw $e;
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ]);
}
?> 