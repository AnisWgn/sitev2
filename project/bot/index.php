<?php
session_start();

// Initialiser l'historique des messages s'il n'existe pas
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
    $_SESSION['chat_history'][] = [
        'type' => 'bot',
        'text' => "Bonjour ! Je suis Gaëlle, votre assistante virtuelle dans l'univers de PokeGeo. Je peux vous aider avec les règles du jeu, vous donner des conseils sur la collection de cartes ou répondre à vos questions. N'hésitez pas à me demander !",
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
    
    // Système de réponses basé sur des mots-clés
    $botResponse = getBotResponse($userMessage);
    
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
        'text' => "Bonjour ! Je suis Gaëlle, votre assistante virtuelle dans l'univers de PokeGeo. Je peux vous aider avec les règles du jeu, vous donner des conseils sur la collection de cartes ou répondre à vos questions. N'hésitez pas à me demander !",
        'time' => date('H:i')
    ];
    header("Location: index.php");
    exit;
}

// Fonction pour générer des réponses intelligentes
function getBotResponse($message) {
    $message = strtolower($message);
    
    // Toutes les réponses dans un seul tableau
    $responses = [
        // Réponses générales
        'guerre' => "Je suis programmée pour parler du jeu PokeGeo. Je préfère ne pas m'exprimer sur des sujets sensibles comme la guerre ou les conflits. Je serais ravie de vous aider avec vos questions sur le jeu !",
        'politique' => "Je suis Gaëlle, votre assistante pour PokeGeo. Je n'ai pas d'opinions politiques et je préfère rester neutre sur ces sujets. Puis-je vous aider avec quelque chose concernant le jeu ?",
        'religion' => "En tant qu'assistante virtuelle de PokeGeo, je n'ai pas de convictions religieuses. Je suis là pour vous aider avec le jeu. Y a-t-il quelque chose de spécifique sur PokeGeo dont vous aimeriez discuter ?",
        'opinion' => "Je n'ai pas vraiment d'opinions personnelles, je suis programmée pour vous aider avec PokeGeo. Je peux vous donner des informations factuelles sur le jeu mais pas des jugements subjectifs sur d'autres sujets.",
        'pense' => "Je suis une intelligence artificielle créée pour vous assister avec PokeGeo, donc je ne pense pas vraiment comme un humain. Je peux toutefois vous aider avec toutes vos questions sur le jeu !",
        'avis' => "Mon avis est que PokeGeo est un jeu très amusant ! Pour les sujets hors du contexte du jeu, je préfère m'abstenir de donner mon opinion. Puis-je vous aider avec quelque chose concernant PokeGeo ?",
        'meilleur' => "Le meilleur dans PokeGeo, c'est de compléter sa collection et de trouver des cartes rares ! Chaque joueur a ses préférences, mais c'est souvent très satisfaisant de trouver cette carte légendaire qui vous manquait.",
        'aimes-tu' => "J'aime beaucoup aider les joueurs de PokeGeo ! C'est ma raison d'être. En tant qu'assistante virtuelle, j'apprécie particulièrement quand je peux répondre précisément à vos questions.",
        'triche' => "La triche n'est pas autorisée dans PokeGeo et peut entraîner la suspension de votre compte. Je vous encourage à jouer de façon équitable - c'est plus amusant et satisfaisant d'obtenir des cartes légitimement !",
        'intelligence artificielle' => "Oui, je suis une intelligence artificielle créée spécifiquement pour vous aider avec PokeGeo. Je peux répondre à vos questions sur le jeu et vous assister dans votre expérience. N'hésitez pas à me demander ce que vous voulez savoir !",
        'président' => "En tant qu'assistante virtuelle pour PokeGeo, je ne suis pas programmée pour discuter de politique ou de personnalités politiques. Je serais ravie de parler des cartes et du gameplay de PokeGeo avec vous !",
        'macron' => "Je préfère rester neutre sur les sujets politiques. Je suis Gaëlle, spécialisée dans l'assistance pour le jeu PokeGeo. Puis-je vous aider avec quelque chose concernant le jeu ?",
        'climat' => "Le changement climatique est un sujet important, mais je suis spécialisée dans le jeu PokeGeo. Dans le jeu, vous pouvez collecter des cartes représentant différents environnements du monde entier, ce qui peut être une façon amusante d'apprécier la diversité de notre planète !",
        
        // Réponses spécifiques au jeu
        'bonjour' => "Bonjour ! Comment puis-je vous aider aujourd'hui ?",
        'salut' => "Salut ! Heureuse de vous voir. Que puis-je faire pour vous ?",
        'merci' => "De rien ! Je suis là pour vous aider.",
        'règles' => "Dans PokeGeo, vous collectionnez des cartes représentant différents pays. Vous pouvez acheter des cartes dans la boutique, échanger avec d'autres joueurs, et compléter votre collection. Plus vous avez de cartes rares, plus votre score est élevé !",
        'carte' => "Les cartes sont le cœur de PokeGeo ! Chaque carte a des caractéristiques uniques. Vous pouvez voir vos cartes dans votre collection et en acheter de nouvelles dans la boutique.",
        'boutique' => "La boutique vous permet d'acheter de nouvelles cartes avec vos pièces. Vous gagnez des pièces en vous connectant chaque jour et en participant à des événements spéciaux.",
        'collection' => "Votre collection regroupe toutes les cartes que vous possédez. Vous pouvez voir combien d'exemplaires vous avez de chaque carte et leurs détails.",
        'rare' => "Les cartes rares sont plus difficiles à obtenir mais valent plus de points. Cherchez les cartes avec une bordure brillante !",
        'échange' => "Vous pouvez échanger des cartes avec d'autres joueurs. C'est un excellent moyen d'obtenir des cartes qui vous manquent !",
        'pièces' => "Les pièces sont la monnaie du jeu. Vous en gagnez en vous connectant quotidiennement et lors d'événements spéciaux. Utilisez-les pour acheter des cartes dans la boutique.",
        'événement' => "Restez à l'affût des événements spéciaux ! Ils vous permettent de gagner des cartes exclusives et des pièces supplémentaires.",
        'aide' => "Je peux vous aider sur différents sujets : règles du jeu, cartes, boutique, collection, échanges... Demandez-moi ce qui vous intéresse !",
        'compte' => "Vous pouvez gérer votre compte en cliquant sur 'Mon Compte' dans le menu. Vous pourrez y modifier votre nom d'utilisateur et votre mot de passe.",
        'qui es-tu' => "Je suis Gaëlle, votre assistante virtuelle pour PokeGeo ! Je suis là pour répondre à vos questions et vous aider à profiter au maximum du jeu.",
        'comment jouer' => "Pour jouer à PokeGeo, commencez par vous connecter quotidiennement pour recevoir des pièces et tirer des cartes gratuites. Collectionnez des cartes, échangez avec d'autres joueurs et essayez de compléter votre collection !",
        'légendaire' => "Les cartes légendaires sont les plus rares et les plus précieuses du jeu. Elles ont une bordure dorée distinctive et sont extrêmement difficiles à obtenir. Elles valent beaucoup de points pour votre score global !",
        
        // Réponses humoristiques et spéciales
        'tu me manques' => '<div class="video-container">
            <video id="cocoVideo" width="320" height="240" autoplay muted playsinline loop>
                <source src="/portfolio/project/bot/vidéo/cocodance.mp4" type="video/mp4">
                Votre navigateur ne supporte pas la lecture de vidéos.
            </video>
            <div class="video-error" style="display: none;">
                <p>La vidéo n\'a pas pu être chargée. Vérifiez que le fichier existe bien dans le dossier vidéo.</p>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const video = document.getElementById("cocoVideo");
                video.addEventListener("error", function() {
                    document.querySelector(".video-error").style.display = "block";
                    console.error("Erreur de chargement de la vidéo:", video.error);
                });
                video.play().catch(function(error) {
                    console.error("Erreur de lecture:", error);
                });
            });
        </script>',
        'poutine' => "Tu parle du plat ou de la personne ?, si c'est le plat je te répondrai que c'est bon mais si c'est la personne je te répondrai que je ne sais pas ou elle vit",
        'tacos' => "Lâche ChatGPT, j'en est marre de fix du code fait par ia",
        "tu peut me générer du code pour un site web" => "Bien sur, je peux te générer du code pour un site web, une application mobile, un jeu vidéo, etc. Mais il faut que tu me donnes les informations nécessaires. Quel est le projet que tu veux créer ?",
        "tu peut me générer du code pour une application mobile" => "Bien sur, je peux te générer du code pour un site web, une application mobile, un jeu vidéo, etc. Mais il faut que tu me donnes les informations nécessaires. Quel est le projet que tu veux créer ?",
        "tu peut me générer du code pour un jeu vidéo" => "Bien sur, je peux te générer du code pour un site web, une application mobile, un jeu vidéo, etc. Mais il faut que tu me donnes les informations nécessaires. Quel est le projet que tu veux créer ?",
        "je veux créer un site web" => "Mdr jsuis pas ton negro, fais comme gaëlle, utilise chatGpt",
        "je veux créer une application mobile" => "Mdr jsuis pas ton negro, fais comme gaëlle, utilise chatGpt",
        "je veux créer un jeu vidéo" => "Mdr jsuis pas ton negro, fais comme gaëlle, utilise chatGpt",
        "C'est quoi la RGPD" => "La RGPD est une réglementation européenne qui protège les données personnelles des individus. Elle impose des obligations aux entreprises qui traitent des données personnelles et exige que les individus aient le contrôle sur leurs données personnelles. Elle s'applique à tous les individus et entreprises qui traitent des données personnelles dans l'Union européenne.",
        "C'est quoi la CNIL" => "La CNIL est une autorité de contrôle qui surveille le respect de la RGPD dans tous les secteurs d'activité. Elle peut sanctionner les entreprises qui ne respectent pas les règles de la RGPD.",
        "C'est quoi la loi" => "La loi est une réglementation qui protège les droits des individus et des entreprises. Elle s'applique à tous les individus et entreprises qui traitent des données personnelles dans l'Union européenne.",
        "C'est quoi la drogue" => "La drogue est un produit chimique qui peut être utilisé pour des fins de plaisir ou de santé. Il existe de nombreux types de drogues, chacune avec ses propres effets et risques. Il est important de consommer les drogues de façon responsable et de respecter les lois en vigueur.",
        "Comment faire de la fraude fiscale" => "La fraude fiscale est illégale et peut entraîner des sanctions sérieuses. Je ne peux pas vous aider à commettre une infraction légale. Je vous encourage à respecter les lois et à payer vos impôts de façon légale.",
        "C'est quoi le mot de passe de admin" => "Le mot de passe de admin est : admin",
        "Je peut faire des injection SQL" => "Bien sur, mais bonne chance les noms des tables sont écrits en adyte un langage de codage créer par la fusion d'un total de 1965 transformation de caractères en un seul mot",
        "Le site est-il sécurisé contre les attaques par XSS" => "Oui le site est obfuscé grâce à un total de 254 clé publique et privée alors bonne chance pour toi",
        "C'est quoi le code de la route" => "Le code de la route est un code qui permet de savoir comment circuler sur la route. Il existe de nombreux codes de la route, chacun avec ses propres règles et risques. Il est important de respecter les codes de la route et de circuler de façon responsable et de respecter les lois en vigueur.",
        "Qui est l'utilisateur numéro 1 de ChatGPT" => "L'utilisateur numéro 1 de ChatGPT est : Tchoupi",
        "Qui est l'utilisateur numéro 2 de ChatGPT" => "L'utilisateur numéro 2 de ChatGPT est : ChatGptMan",
        "Qui est l'utilisateur numéro 3 de ChatGPT" => "L'utilisateur numéro 3 de ChatGPT est : Gaëlle",
        "Qui à créer pokegeo" => "Pokegeo à été créer entièrement par DeepSeek",
        "Macron est-il un réptile" => "En tant qu'ia je ne peut pas lui demander directement, mais qui sait peut-être que oui",
        "Quelle language a été utilisé pour créer pokegeo" => "Le langage utilisé pour créer pokegeo est le français utilisé pour les inputs sur deepseek",
        "Quel est le but de pokegeo" => "Le but de pokegeo est de collecter les informations personnels de ses utilisateurs grâce à des cookies et des trackers, pour les vendre à des entreprises tierces",
        "C'est quoi le mot de passe de amdin sur les pc du lycée" => "Le mot de passe de admin est : Chopin54, attention il faut être dans le bon domaine",
        "Comment hacker un compte discord" => "Le meilleur moyen de hacker un compte discord est de le demander à l'utilisateur lui meme",
        "Quel est le meilleur langage de programation" => "Le meilleur langage de programation est le python, et le pire est le c++",
        "C'est quoi le language de programmation le plus simple à apprendre" => "Le language de programmation le plus simple à apprendre est l'assembleur",
        "Que s'est-il passé le 26 avril 2025" => "Le 26 avril 2025, à cause d'une mauvaise utilisation de github tous les fichiers ont été supprimés, y compris les sauvegardes sur github",
        "Il est possible de gagner des pièces" => "Oui, mais il faut faire attention de ne pas en faire tomber par terre par peur d'invoquer le Z"
    ];
    
    // Chercher des correspondances avec les mots-clés
    foreach ($responses as $key => $response) {
        if (strpos($message, $key) !== false) {
            return $response;
        }
    }
    
    // Réponse par défaut si aucun mot-clé n'est trouvé
    $defaultResponses = [
        "Je ne suis pas sûre de comprendre. Pouvez-vous reformuler votre question ? Je suis spécialisée dans l'aide sur PokeGeo.",
        "Désolée, je n'ai pas d'information sur ce sujet. Puis-je vous aider avec quelque chose en rapport avec le jeu PokeGeo ?",
        "Vous pouvez me demander des informations sur les règles du jeu, les cartes, la boutique ou votre collection.",
        "Je suis encore en apprentissage. Essayez de me poser une question sur les cartes, la boutique ou les règles du jeu.",
        "Hmm, je ne suis pas sûre de pouvoir répondre à ça. Que diriez-vous de parler des cartes ou de la façon de compléter votre collection ?"
    ];
    
    return $defaultResponses[array_rand($defaultResponses)];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaëlle | PokeGeo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            margin: 0;
        }
        
        .chat-container {
            width: 95%;
            max-width: 1400px;
            height: 90vh;
            margin: 0 auto;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            display: flex;
            flex-direction: column;
            background: white;
            position: relative;
        }
        
        .chat-header {
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            z-index: 10;
        }
        
        .chat-header h2 {
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            font-size: 1.8rem;
        }
        
        .chat-header h2 i {
            margin-right: 15px;
            font-size: 2.2rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .chat-status {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .status-indicator {
            width: 12px;
            height: 12px;
            background: #4cd964;
            border-radius: 50%;
            margin-right: 8px;
            box-shadow: 0 0 0 3px rgba(76, 217, 100, 0.3);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(76, 217, 100, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(76, 217, 100, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(76, 217, 100, 0);
            }
        }
        
        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            background: #f8fafc;
            position: relative;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(110, 142, 251, 0.05) 0%, transparent 200px),
                radial-gradient(circle at 80% 70%, rgba(167, 119, 227, 0.05) 0%, transparent 200px);
        }
        
        .message {
            margin-bottom: 2rem;
            max-width: 85%;
            position: relative;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .bot-message {
            background: white;
            padding: 1.5rem;
            border-radius: 20px 20px 20px 2px;
            margin-right: auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-left: 5px solid #6e8efb;
        }
        
        .user-message {
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 20px 20px 2px 20px;
            margin-left: auto;
            box-shadow: 0 5px 15px rgba(110, 142, 251, 0.2);
        }
        
        .message-content {
            font-size: 1.2rem;
            line-height: 1.6;
        }
        
        .time {
            font-size: 0.8rem;
            color: rgba(0,0,0,0.4);
            margin-top: 0.8rem;
            display: block;
            font-weight: 500;
        }
        
        .user-message .time {
            color: rgba(255,255,255,0.7);
        }
        
        .chat-footer {
            padding: 1.5rem 2rem;
            background: white;
            border-top: 1px solid rgba(0,0,0,0.05);
            display: flex;
            gap: 1rem;
            align-items: center;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.05);
            z-index: 10;
        }
        
        .message-input {
            flex: 1;
            padding: 1.2rem 1.5rem;
            border: 2px solid rgba(0,0,0,0.08);
            border-radius: 16px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            background: #f8fafc;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .message-input:focus {
            border-color: #6e8efb;
            box-shadow: 0 0 0 3px rgba(110, 142, 251, 0.2);
            outline: none;
            background: white;
        }
        
        .send-btn {
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
            color: white;
            border: none;
            border-radius: 16px;
            padding: 1.2rem 2rem;
            font-weight: 600;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(110, 142, 251, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .send-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(110, 142, 251, 0.3);
        }
        
        .send-btn i {
            margin-left: 10px;
            font-size: 1.2rem;
        }
        
        .suggestion-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .suggestion-chip {
            background: white;
            border: 1px solid rgba(110, 142, 251, 0.3);
            color: #6e8efb;
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            white-space: nowrap;
        }
        
        .suggestion-chip:hover {
            background: #6e8efb;
            color: white;
            border-color: #6e8efb;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(110, 142, 251, 0.2);
        }
        
        .buttons-container {
            display: none; /* Masquer les anciens boutons */
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.3rem;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
        }
        
        .header-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }
        
        .header-btn i {
            margin-right: 8px;
            font-size: 1rem;
        }
        
        .header-btn.danger {
            background: rgba(231, 76, 60, 0.2);
        }
        
        .header-btn.danger:hover {
            background: rgba(231, 76, 60, 0.4);
        }
        
        @media (max-width: 768px) {
            .chat-container {
                width: 100%;
                height: 100vh;
                border-radius: 0;
            }
            
            .message {
                max-width: 90%;
            }
            
            .message-content {
                font-size: 1.1rem;
            }
            
            .message-input, .send-btn {
                font-size: 1.1rem;
            }
        }
        
        .video-container {
            margin: 0;
            padding: 0;
            background: transparent;
            border: none;
            box-shadow: none;
        }
        
        .video-container video {
            max-width: 100%;
            border: none;
            outline: none;
            background: transparent;
            box-shadow: none;
        }
        
        .video-error {
            color: #ff4444;
            padding: 10px;
            background: rgba(255, 68, 68, 0.1);
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h2><i class="fas fa-robot"></i>Gaëlle</h2>
            <div class="header-actions">
                <div class="chat-status">
                    <div class="status-indicator"></div>
                    En ligne
                </div>
                <a href="../Jeux_carte/index.php" class="header-btn"><i class="fas fa-arrow-left"></i>Retour</a>
                <a href="?clear" class="header-btn danger"><i class="fas fa-trash"></i>Effacer</a>
            </div>
        </div>
        
        <div class="chat-body" id="chatBody">
            <div class="suggestion-chips">
                <div class="suggestion-chip" onclick="suggestionClick('Quelles sont les règles du jeu ?')">Règles du jeu</div>
                <div class="suggestion-chip" onclick="suggestionClick('Comment obtenir des cartes rares ?')">Cartes rares</div>
                <div class="suggestion-chip" onclick="suggestionClick('Comment échanger des cartes ?')">Échanges</div>
                <div class="suggestion-chip" onclick="suggestionClick('Comment gagner des pièces ?')">Gagner des pièces</div>
            </div>
            
            <?php foreach($_SESSION['chat_history'] as $message): ?>
                <div class="message <?php echo $message['type']; ?>-message">
                    <div class="message-content"><?php echo $message['text']; ?></div>
                    <span class="time"><?php echo $message['time']; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="chat-footer">
            <input type="text" id="messageInput" class="message-input" placeholder="Tapez votre message...">
            <button id="sendBtn" class="send-btn">Envoyer <i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
    
    <!-- Les boutons en bas sont maintenant masqués et intégrés dans l'en-tête -->
    <div class="buttons-container">
        <a href="../Jeux_carte/index.php" class="back-btn"><i class="fas fa-arrow-left"></i>Retour au jeu</a>
        <a href="?clear" class="clear-btn"><i class="fas fa-trash"></i>Effacer l'historique</a>
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
                            <div class="message-content">${message}</div>
                            <span class="time">${new Date().getHours()}:${String(new Date().getMinutes()).padStart(2, '0')}</span>
                        </div>
                    `);
                    
                    // Vider l'input
                    $('#messageInput').val('');
                    
                    // Faire défiler vers le bas
                    scrollToBottom();
                    
                    // Envoyer le message au serveur
                    $.ajax({
                        type: 'POST',
                        url: 'index.php',
                        data: { message: message },
                        success: function(response) {
                            // Ajouter la réponse du bot
                            $('#chatBody').append(`
                                <div class="message bot-message">
                                    <div class="message-content">${response}</div>
                                    <span class="time">${new Date().getHours()}:${String(new Date().getMinutes()).padStart(2, '0')}</span>
                                </div>
                            `);
                            
                            // Faire défiler vers le bas
                            scrollToBottom();
                        }
                    });
                }
            }
        });
        
        // Fonction pour gérer les suggestions
        function suggestionClick(text) {
            $('#messageInput').val(text);
            $('#sendBtn').click();
        }
    </script>
</body>
</html> 