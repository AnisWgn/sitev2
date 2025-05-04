<?php
header('Content-Type: application/json');

// Vérifier si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

// Récupérer le message de l'utilisateur
$data = json_decode(file_get_contents('php://input'), true);
$message = $data['message'] ?? '';

if (empty($message)) {
    echo json_encode(['error' => 'Message vide']);
    exit;
}

// Système de réponses basé sur des mots-clés
$responses = [
    'bonjour' => 'Bonjour ! Comment puis-je vous aider aujourd\'hui ?',
    'salut' => 'Salut ! En quoi puis-je vous être utile ?',
    'qui es-tu' => 'Je suis l\'assistant virtuel du portfolio de Wagner Anis, un développeur web Full Stack.',
    'compétences' => 'Wagner maîtrise plusieurs langages et technologies : HTML, CSS, JavaScript, PHP, Java, Python, SQL et Rust.',
    'expérience' => 'Wagner a plus de 2 ans d\'expérience dans le développement web.',
    'projets' => 'Wagner a réalisé 13 projets en équipe et 21 projets personnels.',
    'contact' => 'Vous pouvez me contacter via le formulaire de contact sur le site.',
    'aide' => 'Je peux vous renseigner sur les compétences, l\'expérience et les projets de Wagner. Que souhaitez-vous savoir ?',
    'portfolio' => 'Ce portfolio présente les compétences et réalisations de Wagner Anis, développeur web Full Stack.',
    'développeur' => 'Wagner Anis est un développeur web Full Stack avec plus de 2 ans d\'expérience.',
    'web' => 'Wagner est spécialisé dans le développement web, avec des compétences en front-end et back-end.',
    'full stack' => 'En tant que développeur Full Stack, Wagner maîtrise à la fois le front-end et le back-end.',
    'front-end' => 'Wagner maîtrise les technologies front-end comme HTML, CSS et JavaScript.',
    'back-end' => 'Pour le back-end, Wagner utilise principalement PHP, Java et Python.',
    'langages' => 'Wagner connaît plusieurs langages : HTML, CSS, JavaScript, PHP, Java, Python, SQL et Rust.',
    'technologies' => 'Wagner utilise diverses technologies web modernes pour créer des applications performantes.',
    'cv' => 'Vous pouvez consulter le CV de Wagner dans la section "À propos" du portfolio.',
    'github' => 'Vous pouvez voir les projets de Wagner sur GitHub : https://github.com/AnisWgn',
    'linkedin' => 'Wagner est également présent sur LinkedIn pour des opportunités professionnelles.',
    'merci' => 'Je vous en prie ! N\'hésitez pas si vous avez d\'autres questions.',
    'au revoir' => 'Au revoir ! N\'hésitez pas à revenir si vous avez d\'autres questions.'
];

$message = strtolower(trim($message));
$response = 'Je ne comprends pas votre demande. Pouvez-vous reformuler ou taper "aide" pour voir les sujets que je peux traiter ?';

foreach ($responses as $keyword => $answer) {
    if (strpos($message, $keyword) !== false) {
        $response = $answer;
        break;
    }
}

echo json_encode(['response' => $response]); 