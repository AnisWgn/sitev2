<?php
session_start();

// Initialiser l'historique des messages s'il n'existe pas
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
    $_SESSION['chat_history'][] = [
        'type' => 'bot',
        'text' => "Bonjour ! Je suis Gaëlle, votre assistante virtuelle de test.",
        'time' => date('H:i')
    ];
}

// Traiter la requête AJAX
if (isset($_POST['message'])) {
    $userMessage = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
    
    // Ajouter le message de l'utilisateur à l'historique
    $_SESSION['chat_history'][] = [
        'type' => 'user',
        'text' => $userMessage,
        'time' => date('H:i')
    ];
    
    // Réponse simple pour le test
    $botResponse = "Vous avez dit: " . $userMessage;
    
    // Ajouter la réponse du bot à l'historique
    $_SESSION['chat_history'][] = [
        'type' => 'bot',
        'text' => $botResponse,
        'time' => date('H:i')
    ];
    
    // Renvoyer la réponse
    echo $botResponse;
    exit;
}

// Vider l'historique si demandé
if (isset($_GET['clear'])) {
    $_SESSION['chat_history'] = [];
    $_SESSION['chat_history'][] = [
        'type' => 'bot',
        'text' => "Bonjour ! Je suis Gaëlle, votre assistante virtuelle de test.",
        'time' => date('H:i')
    ];
    header("Location: test.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Chat</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .chat-container { max-width: 600px; margin: 0 auto; border: 1px solid #ccc; border-radius: 5px; overflow: hidden; }
        .chat-header { background: #3498db; color: white; padding: 10px; }
        .chat-body { height: 300px; overflow-y: auto; padding: 10px; }
        .message { margin-bottom: 10px; }
        .bot-message { background: #e3f2fd; padding: 10px; border-radius: 10px; }
        .user-message { background: #f3e5f5; padding: 10px; border-radius: 10px; text-align: right; }
        .chat-footer { padding: 10px; border-top: 1px solid #eee; display: flex; }
        .message-input { flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .send-btn { padding: 8px 15px; background: #3498db; color: white; border: none; border-radius: 4px; margin-left: 10px; cursor: pointer; }
        .time { font-size: 0.8em; color: #777; }
        .clear-btn { padding: 8px 15px; background: #e74c3c; color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h3>Test Chat - Gaëlle</h3>
        </div>
        
        <div class="chat-body" id="chatBody">
            <?php foreach($_SESSION['chat_history'] as $message): ?>
                <div class="message <?php echo $message['type']; ?>-message">
                    <?php echo $message['text']; ?>
                    <div class="time"><?php echo $message['time']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="chat-footer">
            <input type="text" id="messageInput" class="message-input" placeholder="Tapez votre message...">
            <button id="sendBtn" class="send-btn">Envoyer</button>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 20px;">
        <a href="?clear" class="clear-btn">Effacer l'historique</a>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Faire défiler vers le bas
            function scrollToBottom() {
                const chatBody = document.getElementById('chatBody');
                chatBody.scrollTop = chatBody.scrollHeight;
            }
            
            // Appeler au chargement
            scrollToBottom();
            
            // Envoyer le message
            $('#sendBtn').click(function() {
                sendMessage();
            });
            
            // Envoyer avec la touche Entrée
            $('#messageInput').keypress(function(e) {
                if(e.which == 13) {
                    sendMessage();
                    return false;
                }
            });
            
            // Fonction pour envoyer le message
            function sendMessage() {
                const message = $('#messageInput').val().trim();
                
                if(message) {
                    // Ajouter le message de l'utilisateur
                    $('#chatBody').append(`
                        <div class="message user-message">
                            ${message}
                            <div class="time">${new Date().getHours()}:${String(new Date().getMinutes()).padStart(2, '0')}</div>
                        </div>
                    `);
                    
                    // Vider l'input
                    $('#messageInput').val('');
                    
                    // Faire défiler vers le bas
                    scrollToBottom();
                    
                    // Envoyer le message au serveur
                    $.ajax({
                        type: 'POST',
                        url: 'test.php',
                        data: { message: message },
                        success: function(response) {
                            // Ajouter la réponse du bot
                            $('#chatBody').append(`
                                <div class="message bot-message">
                                    ${response}
                                    <div class="time">${new Date().getHours()}:${String(new Date().getMinutes()).padStart(2, '0')}</div>
                                </div>
                            `);
                            
                            // Faire défiler vers le bas
                            scrollToBottom();
                        }
                    });
                }
            }
        });
    </script>
</body>
</html> 