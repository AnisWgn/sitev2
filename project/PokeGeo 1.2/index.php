<?php
session_start();

// Initialisation de la collection si elle n'existe pas
if (!isset($_SESSION['collection'])) {
    $_SESSION['collection'] = [];
}

// Liste des cartes disponibles
$cards = [
    [
        'id' => 1,
        'name' => 'Carte Feu',
        'description' => 'Une carte élémentaire de feu',
        'image' => 'https://via.placeholder.com/300x200/ff0000/ffffff?text=Feu',
        'element' => 'feu'
    ],
    [
        'id' => 2,
        'name' => 'Carte Eau',
        'description' => 'Une carte élémentaire d\'eau',
        'image' => 'https://via.placeholder.com/300x200/0000ff/ffffff?text=Eau',
        'element' => 'eau'
    ],
    [
        'id' => 3,
        'name' => 'Carte Terre',
        'description' => 'Une carte élémentaire de terre',
        'image' => 'https://via.placeholder.com/300x200/8b4513/ffffff?text=Terre',
        'element' => 'terre'
    ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeGeo 1.2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .nav-tabs {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">PokeGeo 1.2</a>
            <div class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="nav-item nav-link text-light">
                        Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                    <a class="nav-item nav-link" href="collection.php">Ma Collection</a>
                    <a class="nav-item nav-link" href="logout.php">Déconnexion</a>
                <?php else: ?>
                    <a class="nav-item nav-link" href="login.php">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Bienvenue sur PokeGeo</h1>
        <p class="text-center mb-4">Découvrez notre collection de cartes</p>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">Toutes les cartes</button>
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
                                <?php if (isset($_SESSION['collection'][$card['id']])): ?>
                                    <span class="collection-badge">Dans ma collection</span>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($card['name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($card['description']); ?></p>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <?php if (!isset($_SESSION['collection'][$card['id']])): ?>
                                            <form method="POST" action="add_to_collection.php">
                                                <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                                                <button type="submit" class="btn btn-primary">Ajouter à ma collection</button>
                                            </form>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p class="text-muted">Connectez-vous pour ajouter cette carte à votre collection</p>
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
                            <p>Votre collection est vide. Ajoutez des cartes pour commencer !</p>
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
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($card['name']); ?></h5>
                                            <p class="card-text"><?php echo htmlspecialchars($card['description']); ?></p>
                                            <form method="POST" action="remove_from_collection.php">
                                                <input type="hidden" name="card_id" value="<?php echo $card['id']; ?>">
                                                <button type="submit" class="btn btn-danger">Retirer de ma collection</button>
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