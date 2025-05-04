<?php
session_start();
require_once 'config.php';

// Vérification si l'utilisateur est connecté et est admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Accès non autorisé']);
    exit;
}

// Vérification de l'action demandée
if (!isset($_POST['action']) || !isset($_POST['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
    exit;
}

$action = $_POST['action'];
$user_id = $_POST['user_id'];

try {
    switch ($action) {
        case 'toggle_status':
            // Récupération du statut actuel
            $stmt = $pdo->prepare("SELECT is_active FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch();
            
            if (!$user) {
                throw new Exception('Utilisateur non trouvé');
            }
            
            // Inversion du statut
            $new_status = !$user['is_active'];
            $stmt = $pdo->prepare("UPDATE users SET is_active = ? WHERE id = ?");
            $stmt->execute([$new_status, $user_id]);
            
            echo json_encode(['success' => true, 'message' => 'Statut mis à jour']);
            break;
            
        case 'delete':
            // Vérification qu'on ne supprime pas le dernier admin
            $stmt = $pdo->prepare("SELECT COUNT(*) as admin_count FROM users WHERE is_admin = 1 AND id != ?");
            $stmt->execute([$user_id]);
            $result = $stmt->fetch();
            
            if ($result['admin_count'] == 0) {
                throw new Exception('Impossible de supprimer le dernier administrateur');
            }
            
            // Suppression de l'utilisateur
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            
            echo json_encode(['success' => true, 'message' => 'Utilisateur supprimé']);
            break;
            
        default:
            throw new Exception('Action non reconnue');
    }
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} 