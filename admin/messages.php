<?php
require_once '../includes/config.php';

// Vérifier si l'utilisateur est connecté et est admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../index.php');
    exit;
}

// Récupérer tous les messages
$query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$stmt = $conn->query($query);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages de Contact - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --card-bg: var(--secondary-color);
            --card-border: var(--accent-color);
            --shadow-color: rgba(0, 0, 0, 0.1);
            --hover-shadow: rgba(0, 0, 0, 0.2);
        }
        
        .messages-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
        }
        
        .messages-container h1 {
            color: var(--accent-color);
            margin-bottom: 2rem;
            font-size: 2.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 1rem;
        }
        
        .messages-container h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--gradient);
        }
        
        .message-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px var(--shadow-color);
            transition: all 0.3s ease;
            border: 1px solid var(--card-border);
            position: relative;
            overflow: hidden;
        }
        
        .message-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px var(--hover-shadow);
        }
        
        .message-card.unread {
            border-left: 4px solid var(--accent-color);
            background: linear-gradient(90deg, var(--card-bg) 0%, var(--secondary-color) 100%);
        }
        
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--card-border);
        }
        
        .message-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .message-sender {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--accent-color);
        }
        
        .message-email {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        .message-date {
            color: var(--text-secondary);
            font-size: 0.9rem;
            background: var(--secondary-color);
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        
        .message-content {
            margin: 1.5rem 0;
            padding: 1rem;
            background: var(--secondary-color);
            border-radius: 10px;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .message-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }
        
        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-delete {
            background: #ff4444;
            color: white;
        }
        
        .btn-mark-read {
            background: var(--accent-color);
            color: var(--primary-color);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px var(--shadow-color);
        }
        
        .no-messages {
            text-align: center;
            padding: 2rem;
            background: var(--card-bg);
            border-radius: 15px;
            color: var(--text-secondary);
            font-size: 1.2rem;
        }
        
        @media (max-width: 768px) {
            .message-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .message-actions {
                flex-direction: column;
                width: 100%;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="messages-container">
        <h1>Messages de Contact</h1>
        
        <?php if (count($messages) > 0): ?>
            <?php foreach($messages as $message): ?>
                <div class="message-card <?php echo $message['is_read'] ? '' : 'unread'; ?>">
                    <div class="message-header">
                        <div class="message-info">
                            <span class="message-sender"><?php echo htmlspecialchars($message['name']); ?></span>
                            <span class="message-email"><?php echo htmlspecialchars($message['email']); ?></span>
                        </div>
                        <span class="message-date">
                            <i class="far fa-clock"></i>
                            <?php echo date('d/m/Y H:i', strtotime($message['created_at'])); ?>
                        </span>
                    </div>
                    <div class="message-content">
                        <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                    </div>
                    <div class="message-actions">
                        <?php if (!$message['is_read']): ?>
                            <form action="mark_read.php" method="POST" style="display: inline;">
                                <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                <button type="submit" class="btn btn-mark-read">
                                    <i class="fas fa-check"></i>
                                    Marquer comme lu
                                </button>
                            </form>
                        <?php endif; ?>
                        <form action="delete_message.php" method="POST" style="display: inline;">
                            <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                                <i class="fas fa-trash"></i>
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-messages">
                <i class="far fa-envelope-open" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <p>Aucun message pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html> 