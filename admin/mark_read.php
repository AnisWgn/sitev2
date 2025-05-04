<?php
session_start();
require_once '../includes/config.php';

// Vérifier si l'utilisateur est connecté et est un admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ' . $base_url . '/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = $_POST['message_id'];
    
    try {
        $stmt = $conn->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?");
        $stmt->execute([$message_id]);
        
        header('Location: ' . $base_url . '/main.php#contact');
        exit();
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour du message : " . $e->getMessage());
        header('Location: ' . $base_url . '/main.php#contact?error=1');
        exit();
    }
} else {
    header('Location: ' . $base_url . '/main.php#contact');
    exit();
} 