<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - BâtiPro | Conducteurs de Travaux Professionnels</title>
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
                    <li><a href="projets.php">Projets Réalisés</a></li>
                    <li><a href="equipe.php">Notre Équipe</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
                </ul>
            </nav>
            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="page-header">
        <div class="container">
            <h1>Contactez-nous</h1>
            <p>Discutons de votre projet de construction ou de rénovation</p>
        </div>
    </section>

    <section class="contact-info-section">
        <div class="container">
            <div class="contact-info-grid">
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Notre Adresse</h3>
                    <p>15 Avenue des Bâtisseurs<br>75001 Paris, France</p>
                </div>
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3>Téléphone</h3>
                    <p>+33 1 23 45 67 89<br>+33 1 23 45 67 90</p>
                </div>
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p>contact@batipro.fr<br>info@batipro.fr</p>
                </div>
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Horaires d'ouverture</h3>
                    <p>Lundi - Vendredi: 8h30 - 18h00<br>Samedi: Sur rendez-vous</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-map">
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.142047342728!2d2.3414306160472316!3d48.8656686792887!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e3ee93b1b27%3A0x110f79b89a8670d!2s15%20Avenue%20des%20Grandes%20Batisseurs%2C%2075001%20Paris%2C%20France!5e0!3m2!1sfr!2sus!4v1625148892967!5m2!1sfr!2sus" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

    <section class="contact-form-section">
        <div class="container">
            <div class="contact-intro">
                <h2>Envoyez-nous un message</h2>
                <p>Nous vous répondrons dans les plus brefs délais pour discuter de votre projet de construction ou de rénovation. N'hésitez pas à nous fournir le maximum de détails pour que nous puissions vous proposer la solution la plus adaptée à vos besoins.</p>
            </div>
            <div class="contact-form-full">
                <form action="traitement.php" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nom">Nom *</label>
                            <input type="text" name="nom" id="nom" placeholder="Votre nom" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom *</label>
                            <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" name="email" id="email" placeholder="Votre email" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" name="telephone" id="telephone" placeholder="Votre téléphone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sujet">Sujet *</label>
                        <input type="text" name="sujet" id="sujet" placeholder="Sujet de votre message" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea name="message" id="message" placeholder="Décrivez votre projet en détail..." required></textarea>
                    </div>
                    <div class="form-group form-checkbox">
                        <input type="checkbox" name="rgpd" id="rgpd" required>
                        <label for="rgpd">J'accepte que mes données soient utilisées pour traiter ma demande de contact conformément à la <a href="politique-confidentialite.php">politique de confidentialité</a> *</label>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn">Envoyer le message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <h2>Besoin d'une réponse rapide ?</h2>
            <p>Appelez-nous directement au +33 1 23 45 67 89 pour discuter immédiatement avec un de nos conducteurs de travaux.</p>
            <a href="tel:+33123456789" class="btn">Appeler maintenant</a>
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
</body>
</html> 