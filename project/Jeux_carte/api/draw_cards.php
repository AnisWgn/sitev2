<?php
// Vérifier la connexion avant d'inclure le header
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Vous devez être connecté pour tirer des cartes']);
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
    // Vérifier si l'utilisateur peut tirer des cartes (1 heure d'attente)
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT last_card_draw FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    
    $user = $stmt->fetch();
    if (!$user) {
        throw new Exception('Utilisateur non trouvé dans la base de données.');
    }

    if (!$user['last_card_draw']) {
        // Si l'utilisateur n'a jamais tiré de carte, on peut l'autoriser à tirer immédiatement
        $last_draw = 0;
    } else {
        $last_draw = strtotime($user['last_card_draw']);
    }

    $now = time();
    $time_diff = $now - $last_draw;

    if ($time_diff < 3600) { // 3600 secondes = 1 heure
        $remaining_time = 3600 - $time_diff;
        throw new Exception('Vous devez attendre encore ' . ceil($remaining_time / 60) . ' minutes avant de pouvoir tirer des cartes.');
    }

    // Démarrer la transaction
    $pdo->beginTransaction();

    try {
        // Sélectionner 2 cartes aléatoires disponibles
        $stmt = $pdo->query('SELECT id, name, image_url, description FROM cards ORDER BY RAND() LIMIT 2');
        $drawn_cards = $stmt->fetchAll();
        
        if (count($drawn_cards) < 2) {
            throw new Exception('Pas assez de cartes disponibles pour le tirage.');
        }

        // Stocker les cartes tirées dans la session
        $_SESSION['last_drawn_cards'] = $drawn_cards;

        // Ajouter les cartes à la collection de l'utilisateur
        foreach ($drawn_cards as $card) {
            // Vérifier si l'utilisateur a déjà cette carte
            $stmt = $pdo->prepare("SELECT quantity FROM user_cards WHERE user_id = ? AND card_id = ?");
            $stmt->execute([$userId, $card['id']]);
            $existing_card = $stmt->fetch();

            if ($existing_card) {
                // Mettre à jour la quantité
                $stmt = $pdo->prepare("UPDATE user_cards SET quantity = quantity + 1 WHERE user_id = ? AND card_id = ?");
                $stmt->execute([$userId, $card['id']]);
            } else {
                // Ajouter une nouvelle carte
                $stmt = $pdo->prepare("INSERT INTO user_cards (user_id, card_id, quantity) VALUES (?, ?, 1)");
                $stmt->execute([$userId, $card['id']]);
            }
        }

        // Mettre à jour le timestamp du dernier tirage
        $stmt = $pdo->prepare("UPDATE users SET last_card_draw = NOW() WHERE id = ?");
        $stmt->execute([$userId]);

        // Valider la transaction
        $pdo->commit();

        // Retourner les cartes tirées
        echo json_encode([
            'success' => true,
            'message' => 'Cartes tirées avec succès !',
            'cards' => $drawn_cards
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
