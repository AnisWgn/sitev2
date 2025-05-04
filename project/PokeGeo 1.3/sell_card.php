<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['card_id'])) {
    $cardId = (int)$_POST['card_id'];
    
    // Liste des cartes avec leurs prix
    $cards = [
        1 => ['price' => 50],
        2 => ['price' => 50],
        3 => ['price' => 50]
    ];
    
    if (isset($cards[$cardId]) && isset($_SESSION['collection'][$cardId])) {
        $price = $cards[$cardId]['price'];
        $sellPrice = floor($price * 0.8); // Prix de vente à 80% du prix d'achat
        
        // Ajouter les pièces
        $_SESSION['coins'] += $sellPrice;
        
        // Retirer la carte de la collection
        $_SESSION['collection'][$cardId]--;
        
        if ($_SESSION['collection'][$cardId] <= 0) {
            unset($_SESSION['collection'][$cardId]);
        }
        
        $_SESSION['success'] = 'Carte vendue avec succès !';
    }
}

header('Location: index.php');
exit();
?> 