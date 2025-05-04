<?php
require_once __DIR__ . '/config.php';

// Fonction pour vérifier si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fonction pour vérifier si l'utilisateur est admin
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #2d3748;
        }
        
        .navbar {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 0.7rem 0;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }
        
        .navbar-brand i {
            color: #ffd700;
            filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.1));
        }
        
        .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 0.8rem 1rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 3px;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(31, 41, 55, 0.1);
            padding: 0.8rem 0;
            margin-top: 10px;
        }
        
        .dropdown-item {
            padding: 0.7rem 1.5rem;
            font-weight: 500;
            color: #4b5563;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #4f46e5;
            padding-left: 1.8rem;
        }
        
        .dropdown-item i {
            width: 1.2rem;
            text-align: center;
            margin-right: 8px;
            color: #6d7280;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin-bottom: 10px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #2d3748;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-nav a:hover {
            background-color: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
        }

        .sidebar-nav a.active {
            background-color: rgba(79, 70, 229, 0.2);
            color: #4f46e5;
        }

        .sidebar-nav i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/portfolio/project/Jeux_carte/index.php">
                <i class="fas fa-dragon"></i> PokeGeo
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/portfolio/project/Jeux_carte/cards.php">
                            <i class="fas fa-th me-1"></i> Cartes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/portfolio/project/bot/index.php">
                            <i class="fas fa-robot me-1"></i> Gaëlle
                        </a>
                    </li>
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/portfolio/project/Jeux_carte/collection.php">
                                <i class="fas fa-book-open me-1"></i> Collection
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/portfolio/project/Jeux_carte/shop.php">
                                <i class="fas fa-shopping-cart me-1"></i> Boutique
                            </a>
                        </li>
                        <?php if (isAdmin()): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cog me-1"></i> Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                    <li>
                                        <a class="dropdown-item" href="/portfolio/project/Jeux_carte/admin/users.php">
                                            <i class="fas fa-users"></i> Utilisateurs
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/portfolio/project/Jeux_carte/admin/cards.php">
                                            <i class="fas fa-th-list"></i> Cartes
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/portfolio/project/Jeux_carte/account.php">
                                            <i class="fas fa-user-cog"></i> Gestion du Compte
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/portfolio/project/Jeux_carte/account.php">
                                <i class="fas fa-user me-1"></i> Mon Compte
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/portfolio/project/Jeux_carte/logout.php">
                                <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/portfolio/project/Jeux_carte/login.php">
                                <i class="fas fa-sign-in-alt me-1"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/portfolio/project/Jeux_carte/register.php">
                                <i class="fas fa-user-plus me-1"></i> Inscription
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="#accueil">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="#apropos">
                        <i class="fas fa-user"></i>
                        <span>À propos</span>
                    </a>
                </li>
                <li>
                    <a href="#projets">
                        <i class="fas fa-code"></i>
                        <span>Projets</span>
                    </a>
                </li>
                <li>
                    <a href="#competences">
                        <i class="fas fa-cogs"></i>
                        <span>Compétences</span>
                    </a>
                </li>
                <li>
                    <a href="#contact">
                        <i class="fas fa-envelope"></i>
                        <span>Contact</span>
                    </a>
                </li>
                <?php if (isAdmin()): ?>
                <li>
                    <a href="admin/messages.php">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>
</html> 