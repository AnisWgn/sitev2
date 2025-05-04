<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Projets Réalisés - BâtiPro | Conducteurs de Travaux Professionnels</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>BâtiPro</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="services.php">Nos Services</a></li>
                    <li><a href="projets.php" class="active">Projets Réalisés</a></li>
                    <li><a href="equipe.php">Notre Équipe</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="page-header">
        <div class="container">
            <h1>Nos Projets Réalisés</h1>
            <p>Découvrez nos réalisations et notre expertise en conduite de travaux</p>
        </div>
    </section>

    <section class="projects-filters">
        <div class="container">
            <div class="filters">
                <button class="filter-btn active" data-filter="all">Tous</button>
                <button class="filter-btn" data-filter="residential">Résidentiel</button>
                <button class="filter-btn" data-filter="commercial">Commercial</button>
                <button class="filter-btn" data-filter="industrial">Industriel</button>
                <button class="filter-btn" data-filter="renovation">Rénovation</button>
            </div>
        </div>
    </section>

    <section class="projects-list">
        <div class="container">
            <div class="projects-grid projects-grid-full">
                <!-- Projet 1 -->
                <div class="project-card project-card-full" data-category="residential">
                    <div class="project-image">
                        <img src="images/projet1.jpg" alt="Résidence Les Cèdres">
                    </div>
                    <div class="project-details">
                        <h3>Résidence Les Cèdres</h3>
                        <div class="project-meta">
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Lyon, France</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>2022 - 2023</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-building"></i>
                                <span>Résidentiel</span>
                            </div>
                        </div>
                        <p>Construction d'un immeuble résidentiel de 40 logements, incluant des espaces communs et un parking souterrain. Notre équipe a assuré la conduite des travaux de la fondation jusqu'à la livraison.</p>
                        <a href="#" class="btn">Voir les détails</a>
                    </div>
                </div>

                <!-- Projet 2 -->
                <div class="project-card project-card-full" data-category="commercial">
                    <div class="project-image">
                        <img src="images/projet2.jpg" alt="Centre Commercial Horizon">
                    </div>
                    <div class="project-details">
                        <h3>Centre Commercial Horizon</h3>
                        <div class="project-meta">
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Marseille, France</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>2020 - 2021</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Commercial</span>
                            </div>
                        </div>
                        <p>Rénovation complète d'un espace commercial de 5000m², comprenant la modernisation des boutiques, des espaces communs et l'amélioration de l'efficacité énergétique du bâtiment.</p>
                        <a href="#" class="btn">Voir les détails</a>
                    </div>
                </div>

                <!-- Projet 3 -->
                <div class="project-card project-card-full" data-category="industrial">
                    <div class="project-image">
                        <img src="images/projet3.jpg" alt="Usine TechnoFab">
                    </div>
                    <div class="project-details">
                        <h3>Usine TechnoFab</h3>
                        <div class="project-meta">
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Lille, France</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>2021 - 2022</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-industry"></i>
                                <span>Industriel</span>
                            </div>
                        </div>
                        <p>Construction d'un bâtiment industriel de 8000m² aux normes écologiques, intégrant des panneaux solaires, un système de récupération des eaux pluviales et une isolation de haute performance.</p>
                        <a href="#" class="btn">Voir les détails</a>
                    </div>
                </div>

                <!-- Projet 4 -->
                <div class="project-card project-card-full" data-category="residential">
                    <div class="project-image">
                        <img src="images/projet4.jpg" alt="Villa Méditerranée">
                    </div>
                    <div class="project-details">
                        <h3>Villa Méditerranée</h3>
                        <div class="project-meta">
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Nice, France</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>2023</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-home"></i>
                                <span>Résidentiel</span>
                            </div>
                        </div>
                        <p>Construction d'une villa de luxe de 450m² avec piscine à débordement, intégrant des technologies domotiques avancées et un design bioclimatique pour optimiser la consommation énergétique.</p>
                        <a href="#" class="btn">Voir les détails</a>
                    </div>
                </div>

                <!-- Projet 5 -->
                <div class="project-card project-card-full" data-category="renovation">
                    <div class="project-image">
                        <img src="images/projet5.jpg" alt="Hôtel Le Royal">
                    </div>
                    <div class="project-details">
                        <h3>Hôtel Le Royal</h3>
                        <div class="project-meta">
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Paris, France</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>2019 - 2020</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-tools"></i>
                                <span>Rénovation</span>
                            </div>
                        </div>
                        <p>Rénovation complète d'un hôtel historique 4 étoiles, incluant la modernisation des 65 chambres, des espaces communs et du restaurant, tout en préservant les éléments architecturaux d'origine.</p>
                        <a href="#" class="btn">Voir les détails</a>
                    </div>
                </div>

                <!-- Projet 6 -->
                <div class="project-card project-card-full" data-category="commercial">
                    <div class="project-image">
                        <img src="images/projet6.jpg" alt="Campus Innovate">
                    </div>
                    <div class="project-details">
                        <h3>Campus Innovate</h3>
                        <div class="project-meta">
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Toulouse, France</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>2021 - 2023</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-briefcase"></i>
                                <span>Commercial</span>
                            </div>
                        </div>
                        <p>Construction d'un campus d'entreprises de 12000m² comprenant des espaces de bureaux modulables, des zones de coworking, un auditorium et des espaces de détente, le tout intégré dans un parc paysager.</p>
                        <a href="#" class="btn">Voir les détails</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <h2>Vous avez un projet de construction ou de rénovation ?</h2>
            <p>Contactez-nous pour discuter de votre projet et bénéficier de notre expertise en conduite de travaux</p>
            <a href="contact.php" class="btn">Demander un devis</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h3>BâtiPro</h3>
                    <p>L'excellence dans la conduite de travaux</p>
                </div>
                <div class="footer-links">
                    <h4>Liens Rapides</h4>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="projets.php">Projets</a></li>
                        <li><a href="equipe.php">Équipe</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-services">
                    <h4>Nos Services</h4>
                    <ul>
                        <li><a href="services.php#conduite">Conduite de Travaux</a></li>
                        <li><a href="services.php#etudes">Études Techniques</a></li>
                        <li><a href="services.php#gestion">Gestion Administrative</a></li>
                        <li><a href="services.php#conseil">Conseil en Construction</a></li>
                    </ul>
                </div>
                <div class="footer-social">
                    <h4>Suivez-nous</h4>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 BâtiPro - Tous droits réservés | <a href="mentions-legales.php">Mentions légales</a> | <a href="politique-confidentialite.php">Politique de confidentialité</a></p>
            </div>
        </div>
    </footer>

    <script src="js/main.js"></script>
    <script>
        // Filtrage des projets
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const projectCards = document.querySelectorAll('.project-card');
            
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Mettre à jour les boutons actifs
                    filterBtns.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    // Filtrer les projets
                    projectCards.forEach(card => {
                        if (filter === 'all' || card.getAttribute('data-category') === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html> 