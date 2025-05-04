<?php
session_start();
require_once '../includes/config.php';

// Vérifier si l'utilisateur est connecté et est admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ' . $base_url . '/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message_id'])) {
    try {
        $message_id = $_POST['message_id'];
        
        // Préparer la requête de suppression
        $query = "DELETE FROM contact_messages WHERE id = :message_id";
        $stmt = $conn->prepare($query);
        
        // Exécuter la requête avec le paramètre
        $stmt->execute(['message_id' => $message_id]);
        
        // Rediriger vers la page principale avec l'ancre contact
        header('Location: ' . $base_url . '/main.php#contact');
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, rediriger avec un message d'erreur
        $_SESSION['error'] = "Erreur lors de la suppression du message : " . $e->getMessage();
        header('Location: ' . $base_url . '/main.php#contact?error=1');
        exit();
    }
} else {
    // Si la requête n'est pas POST ou si l'ID du message n'est pas défini
    header('Location: ' . $base_url . '/main.php#contact');
    exit();
}
?> 