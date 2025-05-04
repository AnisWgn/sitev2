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
    
    if (isset($cards[$cardId])) {
        $price = $cards[$cardId]['price'];
        
        if ($_SESSION['coins'] >= $price) {
            // Déduire le prix des pièces
            $_SESSION['coins'] -= $price;
            
            // Ajouter la carte à la collection
            if (!isset($_SESSION['collection'])) {
                $_SESSION['collection'] = [];
            }
            
            if (!isset($_SESSION['collection'][$cardId])) {
                $_SESSION['collection'][$cardId] = 1;
            } else {
                $_SESSION['collection'][$cardId]++;
            }
            
            $_SESSION['success'] = 'Carte achetée avec succès !';
        } else {
            $_SESSION['error'] = 'Vous n\'avez pas assez de pièces pour acheter cette carte.';
        }
    }
}

header('Location: index.php');
exit();
?> 