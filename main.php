<?php
require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio</title>
    <link rel="stylesheet" href="/portfolio/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="/portfolio/image/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="theme-menu">
        <button class="theme-btn" id="theme-toggle">
            <i class="fas fa-moon"></i>
            <span>Thème</span>
        </button>
    </div>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="profile">
                <a href="login.php" class="profile-image">
                    <img src="image/random.jpg" alt="Photo de profil">
                    <div class="login-overlay">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Se connecter</span>
                    </div>
                </a>
                <h1>Wagner Anis</h1>
                <p>Développeur Web <span class="highlight">WinDev</span></p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-status">
                        <div class="user-info">
                            <i class="fas fa-user-circle"></i>
                            <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        </div>
                        <a href="logout.php" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="active">
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
                    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li>
                        <a href="#messages">
                            <i class="fas fa-envelope"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="social-links">
                <a href="https://github.com/AnisWgn" class="social-link"><i class="fab fa-github"></i></a>
                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&autoplay=1" class="social-link"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <section id="accueil" class="section active">
                <div class="section-content">
                    <div class="welcome-container">
                        <h1>Bonjour, je suis <span class="highlight">Wagner Anis</span></h1>
                        <h2>Développeur Web Full Stack</h2>
                        <p class="intro-text">Je crée des expériences web modernes et intuitives avec une attention particulière aux détails et à l'expérience utilisateur.</p>
                        <div class="cta-buttons">
                            <a href="#projets" class="cta-button primary">
                                <i class="fas fa-code"></i>
                                Voir mes projets
                            </a>
                            <a href="#contact" class="cta-button secondary">
                                <i class="fas fa-envelope"></i>
                                Me contacter
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section id="apropos" class="section">
                <div class="section-content">
                    <div class="section-title">
                        <h2>À Propos de Moi</h2>
                        <p>Développeur passionné par l'innovation et la création d'expériences numériques exceptionnelles</p>
                    </div>
                    <div class="about-grid">
                        <div class="about-text">
                            <p>Je suis un développeur web full-stack passionné, spécialisé dans la création d'applications web modernes et performantes. Mon approche combine expertise technique et sensibilité design pour créer des solutions qui allient fonctionnalité et esthétique.</p>
                            <p>Fort de mon expérience dans le développement web, je m'efforce de créer des applications qui offrent une expérience utilisateur fluide et intuitive. Je mets un point d'honneur à suivre les meilleures pratiques de développement et à me tenir informé des dernières technologies.</p>
                            <div class="about-features">
                                <div class="feature">
                                    <i class="fas fa-code"></i>
                                    <h4>Développement Web</h4>
                                    <p>Création d'applications web modernes et performantes avec les dernières technologies</p>
                                </div>
                                <div class="feature">
                                    <i class="fas fa-mobile-alt"></i>
                                    <h4>Responsive Design</h4>
                                    <p>Interfaces adaptatives optimisées pour tous les appareils et tailles d'écran</p>
                                </div>
                                <div class="feature">
                                    <i class="fas fa-paint-brush"></i>
                                    <h4>UI/UX Design</h4>
                                    <p>Conception d'interfaces intuitives centrées sur l'expérience utilisateur</p>
                                </div>
                            </div>
                        </div>
                        <div class="about-stats">
                            <div class="stat-item">
                                <span class="stat-number">2+</span>
                                <span class="stat-label">Années d'expérience</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">9</span>
                                <span class="stat-label">Langages maîtrisés</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">13</span>
                                <span class="stat-label">Projets en équipe</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">21</span>
                                <span class="stat-label">Projets personnels</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="projets" class="section">
                <div class="section-content">
                    <div class="section-title">
                        <h2>Mes Projets</h2>
                        <p>Découvrez mes réalisations et contributions</p>
                    </div>
                    <div class="project-filters">
                        <button class="filter-btn active" data-filter="all">
                            <i class="fas fa-th-large"></i>
                            Tous
                        </button>
                        <button class="filter-btn" data-filter="html">
                            <i class="fab fa-html5"></i>
                            HTML
                        </button>
                        <button class="filter-btn" data-filter="css">
                            <i class="fab fa-css3-alt"></i>
                            CSS
                        </button>
                        <button class="filter-btn" data-filter="javascript">
                            <i class="fab fa-js"></i>
                            JavaScript
                        </button>
                        <button class="filter-btn" data-filter="php">
                            <i class="fab fa-php"></i>
                            PHP
                        </button>
                        <button class="filter-btn" data-filter="java">
                            <i class="fab fa-java"></i>
                            Java
                        </button>
                        <button class="filter-btn" data-filter="python">
                            <i class="fab fa-python"></i>
                            Python
                        </button>
                        <button class="filter-btn" data-filter="sql">
                            <i class="fas fa-database"></i>
                            SQL
                        </button>
                        <button class="filter-btn" data-filter="rust">
                            <i class="fas fa-code"></i>
                            Rust
                        </button>
                    </div>
                    <div class="projects-grid">
                        <?php include 'includes/projects.php'; ?>
                    </div>
                </div>
            </section>

            <section id="competences" class="section">
                <div class="section-content">
                    <h2>Mes Compétences</h2>
                    <div class="skills-grid">
                    <a href="https://developer.mozilla.org/fr/docs/Web/HTML">
                            <div class="skill-card">
                                <i class="fab fa-html5"></i>
                                <h3>HTML5</h3>
                            </div>
                        </a>

                        <a href="https://developer.mozilla.org/fr/docs/Web/CSS/Reference">
                            <div class="skill-card">
                                <i class="fab fa-css3-alt"></i>
                                <h3>CSS3</h3>
                            </div>
                        </a>

                        <a href="https://developer.mozilla.org/fr/docs/Web/JavaScript">
                            <div class="skill-card">
                                <i class="fab fa-js"></i>
                                <h3>JavaScript</h3>
                            </div>
                        </a>

                        <a href="https://www.php.net/docs.php">
                            <div class="skill-card">
                                <i class="fab fa-php"></i>
                                <h3>PHP</h3>
                            </div>
                        </a>

                        <a href="https://docs.oracle.com/en/java/">
                            <div class="skill-card">
                                <i class="fab fa-java"></i>
                                <h3>JAVA</h3>
                            </div>
                        </a>

                        <a href="https://docs.python.org/3/">
                            <div class="skill-card">
                                <i class="fab fa-python"></i>
                                <h3>Python</h3>
                            </div>
                        </a>

                        <a href="https://sql.sh/">
                            <div class="skill-card">
                                <i class="fa-solid fa-database"></i>
                                <h3>SQL</h3>
                            </div>
                        </a>

                        <a href="https://doc.rust-lang.org/book/">
                            <div class="skill-card">
                                <i class="fa-brands fa-rust"></i>
                                <h3>Rust</h3>
                            </div>
                        </a>

                    </div>
                </div>
            </section>

            <section id="contact" class="section">
                <div class="section-content">
                    <div class="section-title">
                        <h2>Contactez-moi</h2>
                        <p>N'hésitez pas à me contacter pour discuter de vos projets</p>
                    </div>
                    <div class="contact-container">
                        <div class="contact-form">
                            <form id="contactForm">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="text" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Sujet</label>
                                    <input type="text" id="subject" name="subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea id="message" name="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="submit-button">
                                    <i class="fas fa-paper-plane"></i>
                                    Envoyer le message
                                </button>
                            </form>
                        </div>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <h3>Email</h3>
                                    <p>aniswagner6@gmail.com</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <h3>Téléphone</h3>
                                    <p>+33 7 49 28 51 28</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <h3>Localisation</h3>
                                    <p>Nancy, France</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            // Vérification si l'utilisateur est connecté et est admin
            if (isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                // Récupération des utilisateurs
                $stmt = $conn->prepare("SELECT id, username, email, created_at, last_login, is_active FROM users ORDER BY created_at DESC");
                $stmt->execute();
                $users = $stmt->fetchAll();
            ?>
            <section id="admin" class="section">
                <div class="section-content">
                    <div class="section-title">
                        <h2>Gestion des Utilisateurs</h2>
                        <p>Administration des comptes utilisateurs</p>
                    </div>
                    
                    <div class="admin-actions">
                        <button class="admin-button" onclick="showCreateUserForm()">
                            <i class="fas fa-user-plus"></i>
                            Créer un utilisateur
                        </button>
                        <button class="admin-button" onclick="showBanUserForm()">
                            <i class="fas fa-ban"></i>
                            Bannir un utilisateur
                        </button>
                    </div>

                    <div class="users-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom d'utilisateur</th>
                                    <th>Email</th>
                                    <th>Date de création</th>
                                    <th>Dernière connexion</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                                    <td><?php echo $user['last_login'] ? date('d/m/Y H:i', strtotime($user['last_login'])) : 'Jamais'; ?></td>
                                    <td>
                                        <span class="status-badge <?php echo $user['is_active'] ? 'active' : 'inactive'; ?>">
                                            <?php echo $user['is_active'] ? 'Actif' : 'Inactif'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="action-button" onclick="toggleUserStatus(<?php echo $user['id']; ?>)">
                                            <i class="fas fa-power-off"></i>
                                        </button>
                                        <button class="action-button delete" onclick="deleteUser(<?php echo $user['id']; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <?php } ?>

            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
            <section id="messages" class="section">
                <div class="section-content">
                    <div class="section-title">
                        <h2>Messages de Contact</h2>
                        <p>Gestion des messages reçus</p>
                    </div>
                    
                    <div class="messages-container">
                        <?php
                        // Récupérer tous les messages
                        $stmt = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
                        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        
                        <?php if (count($messages) > 0): ?>
                            <?php foreach($messages as $message): ?>
                                <div class="message-card <?php echo $message['is_read'] ? '' : 'unread'; ?>">
                                    <div class="message-header">
                                        <span>De: <?php echo htmlspecialchars($message['name']); ?></span>
                                        <span>Email: <?php echo htmlspecialchars($message['email']); ?></span>
                                        <span>Date: <?php echo date('d/m/Y H:i', strtotime($message['created_at'])); ?></span>
                                    </div>
                                    <div class="message-content">
                                        <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                                    </div>
                                    <div class="message-actions">
                                        <?php if (!$message['is_read']): ?>
                                            <form action="admin/mark_read.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                                <button type="submit" class="btn btn-mark-read">Marquer comme lu</button>
                                            </form>
                                        <?php endif; ?>
                                        <form action="admin/delete_message.php" method="POST" style="display: inline;">
                                            <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                            <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aucun message pour le moment.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>
        </main>
    </div>

    <style>
    a {
        text-decoration: none; /* Removes underline from links */
        color: inherit
    }
    </style>

    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/chatbot.js"></script>
    <script>
        // Gestion du thème
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;
            const icon = themeToggle.querySelector('i');
            
            // Vérifier si un thème est déjà sauvegardé
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                html.setAttribute('data-theme', savedTheme);
                updateThemeIcon(savedTheme);
            }

            // Gestion du changement de thème
            themeToggle.addEventListener('click', () => {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateThemeIcon(newTheme);
            });

            function updateThemeIcon(theme) {
                if (theme === 'dark') {
                    icon.className = 'fas fa-moon';
                } else {
                    icon.className = 'fas fa-sun';
                }
            }
        });

        // Système de filtrage des projets
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const projectCards = document.querySelectorAll('.project-card');
            const projectsGrid = document.querySelector('.projects-grid');

            function reorganizeGrid() {
                // Créer un tableau des cartes visibles
                const visibleCards = Array.from(projectCards).filter(card => !card.classList.contains('hidden'));
                
                // Réorganiser les cartes dans le DOM
                visibleCards.forEach(card => {
                    projectsGrid.appendChild(card);
                });
            }

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Retirer la classe active de tous les boutons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Ajouter la classe active au bouton cliqué
                    button.classList.add('active');

                    const filter = button.getAttribute('data-filter');

                    // Masquer/afficher les cartes
                    projectCards.forEach(card => {
                        if (filter === 'all') {
                            card.classList.remove('hidden');
                        } else {
                            const technologies = card.querySelectorAll('.tech-tag');
                            let hasTechnology = false;
                            
                            technologies.forEach(tech => {
                                const techName = tech.textContent.toLowerCase().trim();
                                if (techName === filter || 
                                    (filter === 'javascript' && techName === 'js') ||
                                    (filter === 'html' && techName === 'html5') ||
                                    (filter === 'css' && techName === 'css3')) {
                                    hasTechnology = true;
                                }
                            });

                            if (hasTechnology) {
                                card.classList.remove('hidden');
                            } else {
                                card.classList.add('hidden');
                            }
                        }
                    });

                    // Réorganiser la grille
                    reorganizeGrid();
                });
            });
        });

        // Gestion de la navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des liens de navigation
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);
                    
                    if (targetSection) {
                        // Masquer toutes les sections
                        document.querySelectorAll('.section').forEach(section => {
                            section.classList.remove('active');
                        });
                        
                        // Afficher la section cible
                        targetSection.classList.add('active');
                        
                        // Mettre à jour la navigation
                        document.querySelectorAll('.sidebar-nav li').forEach(item => {
                            item.classList.remove('active');
                            if (item.querySelector('a').getAttribute('href') === targetId) {
                                item.classList.add('active');
                            }
                        });
                        
                        // Défiler doucement vers la section
                        targetSection.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        });

        function toggleUserStatus(userId) {
            if (confirm('Voulez-vous changer le statut de cet utilisateur ?')) {
                fetch('includes/admin_actions.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=toggle_status&user_id=' + userId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erreur: ' + data.message);
                    }
                });
            }
        }

        function deleteUser(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
                fetch('includes/admin_actions.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=delete&user_id=' + userId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erreur: ' + data.message);
                    }
                });
            }
        }

        function showCreateUserForm() {
            // À implémenter
            alert('Fonctionnalité à venir');
        }

        function showBanUserForm() {
            // À implémenter
            alert('Fonctionnalité à venir');
        }
    </script>
</body>
</html> 