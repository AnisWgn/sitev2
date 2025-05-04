<?php
session_start();

// Initialisation de la collection et des pièces si elles n'existent pas
if (!isset($_SESSION['collection'])) {
    $_SESSION['collection'] = [];
}
if (!isset($_SESSION['coins'])) {
    $_SESSION['coins'] = 100; // Pièces de départ
}
if (!isset($_SESSION['wins'])) {
    $_SESSION['wins'] = 0;
}
if (!isset($_SESSION['losses'])) {
    $_SESSION['losses'] = 0;
}

// Liste des cartes disponibles avec leurs prix et statistiques
$cards = [
    [
        'id' => 1,
        'name' => 'Poisson Rouge',
        'description' => 'Un poisson rouge classique mais puissant',
        'image' => 'https://via.placeholder.com/300x200/ff0000/ffffff?text=Poisson+Rouge',
        'element' => 'eau',
        'price' => 50,
        'attack' => 8,
        'defense' => 4,
        'weakness' => 'terre',
        'strength' => 'feu'
    ],
    [
        'id' => 2,
        'name' => 'Poisson-Clown',
        'description' => 'Un poisson-clown agile et rapide',
        'image' => 'https://via.placeholder.com/300x200/ff9900/ffffff?text=Poisson-Clown',
        'element' => 'eau',
        'price' => 50,
        'attack' => 6,
        'defense' => 6,
        'weakness' => 'terre',
        'strength' => 'feu'
    ],
    [
        'id' => 3,
        'name' => 'Poisson-Chat',
        'description' => 'Un poisson-chat robuste et résistant',
        'image' => 'https://via.placeholder.com/300x200/8b4513/ffffff?text=Poisson-Chat',
        'element' => 'terre',
        'price' => 50,
        'attack' => 7,
        'defense' => 5,
        'weakness' => 'feu',
        'strength' => 'eau'
    ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeFish</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .card {
            margin: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .collection-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8em;
        }
        .price-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #ffc107;
            color: black;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8em;
        }
        .stats-badge {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: #17a2b8;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8em;
        }
        .nav-tabs {
            margin-bottom: 20px;
        }
        .coins-display {
            background-color: #ffc107;
            color: black;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-right: 10px;
        }
        .battle-stats {
            background-color: #28a745;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-right: 10px;
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">PokeFish</a>
            <div class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
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
                    <a class="nav-item nav-link" href="collection.php">Ma Collection</a>
                    <a class="nav-item nav-link" href="battle.php">Combat</a>
                    <a class="nav-item nav-link" href="trade.php">Échange</a>
                    <a class="nav-item nav-link" href="logout.php">Déconnexion</a>
                <?php else: ?>
                    <a class="nav-item nav-link" href="login.php">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Bienvenue sur PokeFish</h1>
        <p class="text-center mb-4">Découvrez notre collection de poissons</p>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">Boutique</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="collection-tab" data-bs-toggle="tab" data-bs-target="#collection" type="button" role="tab">Ma Collection</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                <div class="row">
                    <?php foreach ($cards as $card): ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="<?php echo htmlspecialchars($card['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($card['name']); ?>">
                                <span class="price-badge">
                                    <i class="fas fa-coins"></i> <?php echo $card['price']; ?>
                                </span>
                                <span class="stats-badge">
                                    <i class="fas fa-sword"></i> <?php echo $card['attack']; ?> 
                                    <i class="fas fa-shield"></i> <?php echo $card['defense']; ?>
                                </span>
                                <?php if (isset($_SESSION['collection'][$card['id']])): ?>
                                    <span class="collection-badge">Dans ma collection</span>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <span class="element-icon <?php echo $card['element']; ?>"></span>
                                        <?php echo htmlspecialchars($card['name']); ?>
                                    </h5>
                                    <p class="card-text"><?php echo htmlspecialchars($card['description']); ?></p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            Faiblesse: <span class="element-icon <?php echo $card['weakness']; ?>"></span>
                                            Force: <span class="element-icon <?php echo $card['strength']; ?>"></span>
                                        </small>
                                    </p>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <?php if (!isset($_SESSION['collection'][$card['id']])): ?>
                                            <form method="POST" action="buy_card.php">
                                                <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                                                <button type="submit" class="btn btn-primary" <?php echo ($_SESSION['coins'] < $card['price']) ? 'disabled' : ''; ?>>
                                                    Acheter pour <?php echo $card['price']; ?> <i class="fas fa-coins"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p class="text-muted">Connectez-vous pour acheter cette carte</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="collection" role="tabpanel">
                <div class="row">
                    <?php if (empty($_SESSION['collection'])): ?>
                        <div class="col-12 text-center">
                            <p>Votre collection est vide. Achetez des cartes pour commencer !</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($_SESSION['collection'] as $cardId => $quantity): ?>
                            <?php 
                            $card = array_filter($cards, function($c) use ($cardId) {
                                return $c['id'] == $cardId;
                            });
                            $card = reset($card);
                            if ($card): 
                            ?>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="<?php echo htmlspecialchars($card['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($card['name']); ?>">
                                        <span class="collection-badge">x<?php echo $quantity; ?></span>
                                        <span class="stats-badge">
                                            <i class="fas fa-sword"></i> <?php echo $card['attack']; ?> 
                                            <i class="fas fa-shield"></i> <?php echo $card['defense']; ?>
                                        </span>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <span class="element-icon <?php echo $card['element']; ?>"></span>
                                                <?php echo htmlspecialchars($card['name']); ?>
                                            </h5>
                                            <p class="card-text"><?php echo htmlspecialchars($card['description']); ?></p>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Faiblesse: <span class="element-icon <?php echo $card['weakness']; ?>"></span>
                                                    Force: <span class="element-icon <?php echo $card['strength']; ?>"></span>
                                                </small>
                                            </p>
                                            <form method="POST" action="sell_card.php">
                                                <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                                                <button type="submit" class="btn btn-danger">
                                                    Vendre pour <?php echo floor($card['price'] * 0.8); ?> <i class="fas fa-coins"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 