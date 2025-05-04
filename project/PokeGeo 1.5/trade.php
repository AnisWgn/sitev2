<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Liste des cartes avec leurs statistiques
$cards = [
    1 => [
        'name' => 'Poisson Rouge',
        'element' => 'eau',
        'attack' => 8,
        'defense' => 4,
        'weakness' => 'terre',
        'strength' => 'feu'
    ],
    2 => [
        'name' => 'Poisson-Clown',
        'element' => 'eau',
        'attack' => 6,
        'defense' => 6,
        'weakness' => 'terre',
        'strength' => 'feu'
    ],
    3 => [
        'name' => 'Poisson-Chat',
        'element' => 'terre',
        'attack' => 7,
        'defense' => 5,
        'weakness' => 'feu',
        'strength' => 'eau'
    ]
];

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'propose') {
            if (isset($_POST['card_id']) && isset($_POST['target_card_id'])) {
                $cardId = (int)$_POST['card_id'];
                $targetCardId = (int)$_POST['target_card_id'];
                
                if (isset($_SESSION['collection'][$cardId])) {
                    $_SESSION['trade_proposal'] = [
                        'card_id' => $cardId,
                        'target_card_id' => $targetCardId,
                        'status' => 'pending'
                    ];
                    $message = 'Proposition d\'échange envoyée !';
                } else {
                    $error = 'Vous ne possédez pas ce poisson.';
                }
            }
        } elseif ($_POST['action'] === 'accept') {
            if (isset($_SESSION['trade_proposal'])) {
                $proposal = $_SESSION['trade_proposal'];
                
                // Vérifier que les deux joueurs possèdent toujours les cartes
                if (isset($_SESSION['collection'][$proposal['card_id']]) && 
                    isset($_SESSION['collection'][$proposal['target_card_id']])) {
                    
                    // Échanger les cartes
                    $temp = $_SESSION['collection'][$proposal['card_id']];
                    $_SESSION['collection'][$proposal['card_id']] = $_SESSION['collection'][$proposal['target_card_id']];
                    $_SESSION['collection'][$proposal['target_card_id']] = $temp;
                    
                    $message = 'Échange effectué avec succès !';
                    unset($_SESSION['trade_proposal']);
                } else {
                    $error = 'L\'échange n\'est plus possible.';
                }
            }
        } elseif ($_POST['action'] === 'reject') {
            unset($_SESSION['trade_proposal']);
            $message = 'Proposition d\'échange rejetée.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Échange - PokeFish</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .trade-container {
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
        .element-icon {
            width: 20px;
            height: 20px;
            display: inline-block;
            margin-right: 5px;
        }
        .eau { background-color: #0000ff; }
        .terre { background-color: #8b4513; }
        .feu { background-color: #ff0000; }
        .trade-arrow {
            font-size: 2em;
            text-align: center;
            margin: 20px 0;
        }
        .proposal-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">PokeFish</a>
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
                <a class="nav-item nav-link" href="battle.php">Combat</a>
                <a class="nav-item nav-link" href="logout.php">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="trade-container">
            <h1 class="text-center mb-4">Échange de poissons</h1>
            
            <?php if ($message): ?>
                <div class="alert alert-success">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['trade_proposal'])): ?>
                <div class="proposal-container">
                    <h3 class="text-center mb-3">Proposition d'échange en cours</h3>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <span class="element-icon <?php echo $cards[$_SESSION['trade_proposal']['card_id']]['element']; ?>"></span>
                                        <?php echo htmlspecialchars($cards[$_SESSION['trade_proposal']['card_id']]['name']); ?>
                                    </h5>
                                    <p class="card-text">
                                        <i class="fas fa-sword"></i> <?php echo $cards[$_SESSION['trade_proposal']['card_id']]['attack']; ?> 
                                        <i class="fas fa-shield"></i> <?php echo $cards[$_SESSION['trade_proposal']['card_id']]['defense']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="trade-arrow">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <span class="element-icon <?php echo $cards[$_SESSION['trade_proposal']['target_card_id']]['element']; ?>"></span>
                                        <?php echo htmlspecialchars($cards[$_SESSION['trade_proposal']['target_card_id']]['name']); ?>
                                    </h5>
                                    <p class="card-text">
                                        <i class="fas fa-sword"></i> <?php echo $cards[$_SESSION['trade_proposal']['target_card_id']]['attack']; ?> 
                                        <i class="fas fa-shield"></i> <?php echo $cards[$_SESSION['trade_proposal']['target_card_id']]['defense']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <form method="POST" action="" class="d-inline">
                            <input type="hidden" name="action" value="accept">
                            <button type="submit" class="btn btn-success me-2">Accepter</button>
                        </form>
                        <form method="POST" action="" class="d-inline">
                            <input type="hidden" name="action" value="reject">
                            <button type="submit" class="btn btn-danger">Refuser</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-5">
                        <h3 class="text-center mb-3">Vos poissons</h3>
                        <?php if (empty($_SESSION['collection'])): ?>
                            <div class="alert alert-warning">
                                Vous n'avez pas de poissons à échanger.
                            </div>
                        <?php else: ?>
                            <form method="POST" action="">
                                <input type="hidden" name="action" value="propose">
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
                                                            Proposer ce poisson
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
                        <div class="trade-arrow">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <h3 class="text-center mb-3">Poissons disponibles</h3>
                        <div class="row">
                            <?php foreach ($cards as $cardId => $card): ?>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <span class="element-icon <?php echo $card['element']; ?>"></span>
                                                <?php echo htmlspecialchars($card['name']); ?>
                                            </h5>
                                            <p class="card-text">
                                                <i class="fas fa-sword"></i> <?php echo $card['attack']; ?> 
                                                <i class="fas fa-shield"></i> <?php echo $card['defense']; ?>
                                            </p>
                                            <form method="POST" action="">
                                                <input type="hidden" name="action" value="propose">
                                                <input type="hidden" name="target_card_id" value="<?php echo $cardId; ?>">
                                                <button type="submit" class="btn btn-outline-primary w-100">
                                                    Échanger contre ce poisson
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 