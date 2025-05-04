<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Liste des cartes avec leurs statistiques
$cards = [
    1 => [
        'name' => 'Carte Feu',
        'element' => 'feu',
        'attack' => 8,
        'defense' => 4,
        'weakness' => 'eau',
        'strength' => 'terre'
    ],
    2 => [
        'name' => 'Carte Eau',
        'element' => 'eau',
        'attack' => 6,
        'defense' => 6,
        'weakness' => 'terre',
        'strength' => 'feu'
    ],
    3 => [
        'name' => 'Carte Terre',
        'element' => 'terre',
        'attack' => 7,
        'defense' => 5,
        'weakness' => 'feu',
        'strength' => 'eau'
    ]
];

$message = '';
$battleResult = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['card_id'])) {
    $playerCardId = (int)$_POST['card_id'];
    
    if (isset($_SESSION['collection'][$playerCardId])) {
        // Sélectionner une carte aléatoire pour l'IA
        $aiCardId = array_rand($cards);
        
        $playerCard = $cards[$playerCardId];
        $aiCard = $cards[$aiCardId];
        
        // Calculer les dégâts
        $playerDamage = $playerCard['attack'];
        $aiDamage = $aiCard['attack'];
        
        // Appliquer les bonus/malus d'éléments
        if ($playerCard['strength'] === $aiCard['element']) {
            $playerDamage *= 1.5;
        }
        if ($playerCard['weakness'] === $aiCard['element']) {
            $playerDamage *= 0.5;
        }
        if ($aiCard['strength'] === $playerCard['element']) {
            $aiDamage *= 1.5;
        }
        if ($aiCard['weakness'] === $playerCard['element']) {
            $aiDamage *= 0.5;
        }
        
        // Calculer les points de vie finaux
        $playerHP = $playerCard['defense'] - $aiDamage;
        $aiHP = $aiCard['defense'] - $playerDamage;
        
        // Déterminer le gagnant
        if ($playerHP > $aiHP) {
            $battleResult = 'win';
            $_SESSION['wins']++;
            $_SESSION['coins'] += 20; // Récompense pour la victoire
            $message = 'Victoire ! Vous avez gagné 20 pièces.';
        } else if ($playerHP < $aiHP) {
            $battleResult = 'loss';
            $_SESSION['losses']++;
            $message = 'Défaite...';
        } else {
            $battleResult = 'draw';
            $_SESSION['coins'] += 10; // Récompense pour l\'égalité
            $message = 'Match nul ! Vous avez gagné 10 pièces.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat - PokeGeo 1.4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .battle-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card {
            margin: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .element-icon {
            width: 20px;
            height: 20px;
            display: inline-block;
            margin-right: 5px;
        }
        .fire { background-color: #ff0000; }
        .water { background-color: #0000ff; }
        .earth { background-color: #8b4513; }
        .vs {
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .battle-result {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .win { background-color: #d4edda; color: #155724; }
        .loss { background-color: #f8d7da; color: #721c24; }
        .draw { background-color: #fff3cd; color: #856404; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">PokeGeo 1.4</a>
            <div class="navbar-nav ms-auto">
                <span class="nav-item nav-link text-light">
                    Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?>
                </span>
                <span class="nav-item nav-link coins-display">
                    <i class="fas fa-coins"></i> <?php echo $_SESSION['coins']; ?>
                </span>
                <span class="nav-item nav-link battle-stats">
                    <i class="fas fa-trophy"></i> <?php echo $_SESSION['wins']; ?> / 
                    <i class="fas fa-skull"></i> <?php echo $_SESSION['losses']; ?>
                </span>
                <a class="nav-item nav-link" href="index.php">Accueil</a>
                <a class="nav-item nav-link" href="logout.php">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="battle-container">
            <h1 class="text-center mb-4">Combat</h1>
            
            <?php if ($message): ?>
                <div class="battle-result <?php echo $battleResult; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-5">
                    <h3 class="text-center mb-3">Votre carte</h3>
                    <?php if (empty($_SESSION['collection'])): ?>
                        <div class="alert alert-warning">
                            Vous n'avez pas de cartes dans votre collection. Achetez des cartes pour combattre !
                        </div>
                    <?php else: ?>
                        <form method="POST" action="">
                            <div class="row">
                                <?php foreach ($_SESSION['collection'] as $cardId => $quantity): ?>
                                    <?php if (isset($cards[$cardId])): ?>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <span class="element-icon <?php echo $cards[$cardId]['element']; ?>"></span>
                                                        <?php echo htmlspecialchars($cards[$cardId]['name']); ?>
                                                    </h5>
                                                    <p class="card-text">
                                                        <i class="fas fa-sword"></i> <?php echo $cards[$cardId]['attack']; ?> 
                                                        <i class="fas fa-shield"></i> <?php echo $cards[$cardId]['defense']; ?>
                                                    </p>
                                                    <button type="submit" name="card_id" value="<?php echo $cardId; ?>" class="btn btn-primary w-100">
                                                        Choisir cette carte
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-2">
                    <div class="vs">VS</div>
                </div>
                
                <div class="col-md-5">
                    <h3 class="text-center mb-3">Carte de l'IA</h3>
                    <?php if (isset($aiCard)): ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <span class="element-icon <?php echo $aiCard['element']; ?>"></span>
                                    <?php echo htmlspecialchars($aiCard['name']); ?>
                                </h5>
                                <p class="card-text">
                                    <i class="fas fa-sword"></i> <?php echo $aiCard['attack']; ?> 
                                    <i class="fas fa-shield"></i> <?php echo $aiCard['defense']; ?>
                                </p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Choisissez une carte pour commencer le combat
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 