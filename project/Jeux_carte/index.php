<?php
// Inclure la configuration de la base de données en premier
require_once 'config/database.php';

// Inclure le header qui gère la session
require_once 'includes/header.php';

// Vérifier si l'utilisateur est connecté
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}
?>

<style>
    .hero-section {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        padding: 3.5rem 0;
        margin-bottom: 3rem;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.25);
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -70px;
        left: -70px;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        z-index: 0;
    }

    .hero-title {
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
        position: relative;
        z-index: 1;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        font-weight: 400;
        opacity: 0.9;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }
    
    .hero-btn {
        background-color: white;
        color: #4f46e5;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        position: relative;
        z-index: 1;
    }
    
    .hero-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 15px rgba(0, 0, 0, 0.2);
        color: #4338ca;
    }

    .feature-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        height: 100%;
        margin-bottom: 1.5rem;
        box-shadow: 0 10px 25px rgba(31, 41, 55, 0.07);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .feature-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 15px 30px rgba(31, 41, 55, 0.1);
    }
    
    .feature-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #4f46e5, #7c3aed);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }
    
    .feature-card:hover::after {
        transform: scaleX(1);
    }

    .feature-icon {
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        color: #4f46e5;
        background: rgba(79, 70, 229, 0.08);
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        transform: scale(1.1);
        background: rgba(79, 70, 229, 0.15);
    }
    
    .feature-title {
        font-weight: 600;
        font-size: 1.4rem;
        margin-bottom: 1rem;
        color: #2d3748;
    }
    
    .feature-text {
        color: #6b7280;
        font-size: 1.05rem;
        line-height: 1.6;
    }

    .action-section {
        background: #f3f4f6;
        padding: 3rem 0;
        margin-top: 3rem;
        border-radius: 16px;
        box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .action-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        height: 100%;
        box-shadow: 0 10px 25px rgba(31, 41, 55, 0.07);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }
    
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(31, 41, 55, 0.1);
    }
    
    .action-title {
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 0.7rem;
        color: #2d3748;
    }
    
    .action-text {
        color: #6b7280;
        font-size: 1.05rem;
        margin-bottom: 1.5rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border: none;
        font-weight: 500;
        padding: 12px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 15px rgba(79, 70, 229, 0.35);
        background-image: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
    }
    
    .btn-primary:active {
        transform: translateY(-1px);
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        font-weight: 500;
        padding: 12px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
    }
    
    .btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 15px rgba(16, 185, 129, 0.35);
        background-image: linear-gradient(135deg, #059669 0%, #047857 100%);
    }
    
    .btn-success:active {
        transform: translateY(-1px);
    }
    
    /* Modal styles */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }
    
    .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem 2rem;
    }
    
    .modal-title {
        font-weight: 600;
        color: #2d3748;
    }
    
    .modal-body {
        padding: 2rem;
    }
    
    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem 2rem;
    }
    
    .btn-close {
        box-shadow: none;
        opacity: 0.5;
    }
    
    .btn-close:hover {
        opacity: 0.8;
    }
    
    .lead {
        font-size: 1.2rem;
        color: #4b5563;
    }
    
    /* Card animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .card-animated {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }
    
    /* Timer display */
    #countdownTimer {
        padding: 10px;
        background: rgba(79, 70, 229, 0.08);
        border-radius: 8px;
        margin-top: 10px;
        color: #4f46e5;
        font-weight: 500;
    }

    /* Style pour le bouton chatbot */
    .chatbot-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
        color: white;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        z-index: 1000;
        border: none;
        text-decoration: none;
    }
    
    .chatbot-button:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        color: white;
    }
    
    .chatbot-button i {
        font-size: 1.8rem;
    }
</style>

<div class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Bienvenue sur PokeGeo</h1>
        <p class="hero-subtitle">Collectionnez des cartes virtuelles uniques de vos pays préférés !</p>
        <?php if (!isLoggedIn()): ?>
            <a class="hero-btn" href="register.php">
                <i class="fas fa-user-plus me-2"></i>S'inscrire
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-gem"></i>
                </div>
                <h3 class="feature-title">Collectionnez</h3>
                <p class="feature-text">Obtenez des cartes uniques toutes les heures et créez votre collection personnelle.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-globe-americas"></i>
                </div>
                <h3 class="feature-title">Explorez</h3>
                <p class="feature-text">Découvrez de nouvelles cartes représentant différents pays et leur histoire fascinante.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <h3 class="feature-title">Échangez</h3>
                <p class="feature-text">Partagez vos cartes avec d'autres joueurs et complétez votre collection.</p>
            </div>
        </div>
    </div>

    <?php if (isLoggedIn()): ?>
        <div class="action-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="action-card">
                        <h3 class="action-title">Votre Collection</h3>
                        <p class="action-text">Consultez votre collection de cartes et organisez vos trésors.</p>
                        <a href="collection.php" class="btn btn-primary">
                            <i class="fas fa-book-open me-2"></i>Voir ma collection
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="action-card">
                        <h3 class="action-title">Obtenir des Cartes</h3>
                        <p class="action-text">Cliquez pour obtenir 2 cartes aléatoires et agrandir votre collection.</p>
                        <button id="drawButton" class="btn btn-success">
                            <i class="fas fa-random me-2"></i>Obtenir des cartes
                        </button>
                        <div id="countdownTimer" class="mt-2" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour afficher les cartes tirées -->
        <div class="modal fade" id="cardsModal" tabindex="-1" aria-labelledby="cardsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cardsModalLabel">Vos nouvelles cartes !</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <p class="lead">Félicitations ! Vous avez obtenu ces cartes :</p>
                        </div>
                        <div class="row" id="drawnCards">
                            <!-- Les cartes tirées seront ajoutées ici par JavaScript -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Super !</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const drawButton = document.getElementById('drawButton');
    const countdownTimer = document.getElementById('countdownTimer');
    
    if (drawButton) {
        // Vérifier s'il y a un délai enregistré en localStorage
        const nextDrawTime = localStorage.getItem('nextDrawTime');
        
        if (nextDrawTime && parseInt(nextDrawTime) > Date.now()) {
            // Désactiver le bouton et afficher le compte à rebours
            drawButton.disabled = true;
            countdownTimer.style.display = 'block';
            updateCountdown();
            const countdown = setInterval(updateCountdown, 1000);
            
            function updateCountdown() {
                const timeLeft = parseInt(nextDrawTime) - Date.now();
                
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    drawButton.disabled = false;
                    countdownTimer.style.display = 'none';
                    return;
                }
                
                const minutes = Math.floor(timeLeft / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                countdownTimer.textContent = `Prochain tirage dans ${minutes}m ${seconds}s`;
            }
        }
        
        drawButton.addEventListener('click', function() {
            drawButton.disabled = true;
            drawButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Tirage...';
            
            fetch('api/draw_cards.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur réseau: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        fetch('api/get_drawn_cards.php')
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Erreur réseau: ' + response.status);
                                }
                                return response.json();
                            })
                            .then(cardData => {
                                if (cardData.success) {
                                    showDrawnCards(cardData.cards);
                                    
                                    const nextDrawTime = Date.now() + (60 * 60 * 1000); // 1 heure
                                    localStorage.setItem('nextDrawTime', nextDrawTime);
                                    
                                    drawButton.innerHTML = '<i class="fas fa-random me-2"></i>Obtenir des cartes';
                                    
                                    countdownTimer.style.display = 'block';
                                    updateCountdown();
                                    const countdown = setInterval(updateCountdown, 1000);
                                    
                                    function updateCountdown() {
                                        const timeLeft = parseInt(nextDrawTime) - Date.now();
                                        
                                        if (timeLeft <= 0) {
                                            clearInterval(countdown);
                                            drawButton.disabled = false;
                                            countdownTimer.style.display = 'none';
                                            return;
                                        }
                                        
                                        const minutes = Math.floor(timeLeft / (1000 * 60));
                                        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                                        countdownTimer.textContent = `Prochain tirage dans ${minutes}m ${seconds}s`;
                                    }
                                } else {
                                    alert(cardData.message || 'Erreur lors de la récupération des cartes');
                                    drawButton.disabled = false;
                                    drawButton.innerHTML = '<i class="fas fa-random me-2"></i>Obtenir des cartes';
                                }
                            })
                            .catch(error => {
                                alert('Erreur: ' + error.message);
                                drawButton.disabled = false;
                                drawButton.innerHTML = '<i class="fas fa-random me-2"></i>Obtenir des cartes';
                            });
                    } else {
                        alert(data.message || 'Erreur lors du tirage des cartes');
                        
                        if (data.message && data.message.includes('attendre encore')) {
                            const minutesMatch = data.message.match(/(\d+) minutes/);
                            if (minutesMatch && minutesMatch[1]) {
                                const minutes = parseInt(minutesMatch[1]);
                                const nextDrawTime = Date.now() + (minutes * 60 * 1000);
                                localStorage.setItem('nextDrawTime', nextDrawTime);
                                
                                countdownTimer.style.display = 'block';
                                updateCountdown();
                                const countdown = setInterval(updateCountdown, 1000);
                                
                                function updateCountdown() {
                                    const timeLeft = parseInt(nextDrawTime) - Date.now();
                                    
                                    if (timeLeft <= 0) {
                                        clearInterval(countdown);
                                        drawButton.disabled = false;
                                        countdownTimer.style.display = 'none';
                                        return;
                                    }
                                    
                                    const minutes = Math.floor(timeLeft / (1000 * 60));
                                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                                    countdownTimer.textContent = `Prochain tirage dans ${minutes}m ${seconds}s`;
                                }
                            } else {
                                drawButton.disabled = false;
                            }
                        } else {
                            drawButton.disabled = false;
                        }
                        
                        drawButton.innerHTML = '<i class="fas fa-random me-2"></i>Obtenir des cartes';
                    }
                })
                .catch(error => {
                    alert('Erreur: ' + error.message);
                    drawButton.disabled = false;
                    drawButton.innerHTML = '<i class="fas fa-random me-2"></i>Obtenir des cartes';
                });
        });
    }
});

// Fonction pour afficher les cartes tirées
function showDrawnCards(cards) {
    const cardsContainer = document.getElementById('drawnCards');
    cardsContainer.innerHTML = '';
    
    cards.forEach((card, index) => {
        const cardCol = document.createElement('div');
        cardCol.className = 'col-md-6 mb-4';
        
        const cardElement = document.createElement('div');
        cardElement.className = 'card card-animated';
        cardElement.style.borderRadius = '12px';
        cardElement.style.overflow = 'hidden';
        cardElement.style.boxShadow = '0 10px 25px rgba(31, 41, 55, 0.07)';
        cardElement.style.animationDelay = `${index * 0.2}s`;
        
        // Contenu de la carte
        const cardImage = document.createElement('img');
        cardImage.src = card.image_url;
        cardImage.className = 'card-img-top';
        cardImage.style.height = '200px';
        cardImage.style.objectFit = 'contain';
        cardImage.style.padding = '1rem';
        cardImage.style.background = '#f9fafc';
        cardImage.alt = card.name;
        
        const cardBody = document.createElement('div');
        cardBody.className = 'card-body text-center';
        cardBody.style.padding = '1.5rem';
        
        const cardTitle = document.createElement('h5');
        cardTitle.className = 'card-title';
        cardTitle.style.fontWeight = '600';
        cardTitle.style.marginBottom = '0.7rem';
        cardTitle.style.color = '#2d3748';
        cardTitle.textContent = card.name;
        
        const cardRarity = document.createElement('p');
        cardRarity.className = 'card-text';
        
        const rarityColors = {
            'Commune': 'secondary',
            'Peu commune': 'primary',
            'Rare': 'info',
            'Très rare': 'warning',
            'Légendaire': 'danger'
        };
        
        const badgeColor = rarityColors[card.rarity] || 'secondary';
        
        cardRarity.innerHTML = `<small>Rareté: <span class="badge bg-${badgeColor}" style="padding: 5px 10px; font-weight: 500;">${card.rarity}</span></small>`;
        
        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardRarity);
        
        cardElement.appendChild(cardImage);
        cardElement.appendChild(cardBody);
        
        cardCol.appendChild(cardElement);
        cardsContainer.appendChild(cardCol);
    });
    
    const cardsModal = new bootstrap.Modal(document.getElementById('cardsModal'));
    cardsModal.show();
}

// Fonction pour obtenir la couleur en fonction de la rareté
function getRarityColor(rarity) {
    switch(rarity) {
        case 'Commune': return 'secondary';
        case 'Peu commune': return 'primary';
        case 'Rare': return 'info';
        case 'Très rare': return 'warning';
        case 'Légendaire': return 'danger';
        default: return 'secondary';
    }
}
</script>

<!-- Section d'assistant virtuel - version améliorée et agrandie -->
<div class="container-fluid my-5 py-5" style="background: linear-gradient(135deg, #f0f4ff 0%, #e6e9fd 100%);">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-7">
                <div class="p-4 rounded-4" style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); box-shadow: 0 10px 30px rgba(110, 142, 251, 0.2);">
                    <h2 class="mb-4" style="color: #4f46e5; font-weight: 700;"><i class="fas fa-robot me-3"></i>Tako, votre assistante virtuelle</h2>
                    <p class="lead mb-3" style="font-size: 1.25rem; color: #4b5563;">Vous avez des questions sur le jeu ? Tako est là pour vous guider en temps réel !</p>
                    <p class="mb-4" style="color: #6b7280; font-size: 1.1rem;">Obtenez des réponses instantanées sur les règles du jeu, les cartes disponibles, comment échanger avec d'autres joueurs, et tous les aspects du jeu qui vous intéressent. Notre assistante intelligente est disponible 24/7 pour vous aider.</p>
                    <a href="../bot/index.php" class="btn btn-lg mt-2 px-4 py-3" style="background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%); color: white; font-weight: 600; border-radius: 12px; box-shadow: 0 6px 15px rgba(110, 142, 251, 0.4); transition: all 0.3s ease;">
                        <i class="fas fa-comment-dots me-2"></i>Discuter avec Tako
                    </a>
                </div>
            </div>
            <div class="col-md-5 text-center">
                <!-- Nouveau robot amélioré et coloré -->
                <div style="position: relative; width: 100%; max-width: 300px; margin: 0 auto;">
                    <!-- Robot principal - style moderne -->
                    <div style="background: linear-gradient(135deg, #6186FF 0%, #8B5CF6 100%); width: 260px; height: 260px; border-radius: 50%; margin: 0 auto; position: relative; box-shadow: 0 20px 40px rgba(110, 142, 251, 0.4);">
                        <!-- Visage du robot -->
                        <div style="position: absolute; width: 200px; height: 120px; left: 30px; top: 60px; background: white; border-radius: 20px; overflow: hidden;">
                            <!-- Écran facial - gradient animé -->
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, #E0E7FF 0%, #EEF2FF 100%); opacity: 0.8;"></div>
                            
                            <!-- Yeux du robot -->
                            <div style="position: absolute; width: 40px; height: 40px; background: #4F46E5; border-radius: 50%; top: 30px; left: 40px; box-shadow: 0 0 0 5px rgba(79, 70, 229, 0.3);"></div>
                            <div style="position: absolute; width: 40px; height: 40px; background: #4F46E5; border-radius: 50%; top: 30px; left: 120px; box-shadow: 0 0 0 5px rgba(79, 70, 229, 0.3);"></div>
                            
                            <!-- Reflets dans les yeux -->
                            <div style="position: absolute; width: 12px; height: 12px; background: white; border-radius: 50%; top: 35px; left: 45px;"></div>
                            <div style="position: absolute; width: 12px; height: 12px; background: white; border-radius: 50%; top: 35px; left: 125px;"></div>
                            
                            <!-- Bouche -->
                            <div style="position: absolute; width: 80px; height: 10px; background: #4F46E5; border-radius: 5px; bottom: 30px; left: 60px;"></div>
                        </div>
                        
                        <!-- Antennes -->
                        <div style="position: absolute; width: 10px; height: 40px; background: #A855F7; top: -35px; left: 90px; border-radius: 5px; transform: rotate(-15deg);"></div>
                        <div style="position: absolute; width: 10px; height: 40px; background: #A855F7; top: -35px; left: 160px; border-radius: 5px; transform: rotate(15deg);"></div>
                        <div style="position: absolute; width: 20px; height: 20px; background: #F59E0B; border-radius: 50%; top: -50px; left: 85px; box-shadow: 0 0 10px rgba(245, 158, 11, 0.6);"></div>
                        <div style="position: absolute; width: 20px; height: 20px; background: #F59E0B; border-radius: 50%; top: -50px; left: 155px; box-shadow: 0 0 10px rgba(245, 158, 11, 0.6);"></div>
                        
                        <!-- Oreilles/écouteurs -->
                        <div style="position: absolute; width: 30px; height: 60px; background: #EEF2FF; border-radius: 15px; top: 80px; left: -10px; transform: rotate(-10deg);"></div>
                        <div style="position: absolute; width: 30px; height: 60px; background: #EEF2FF; border-radius: 15px; top: 80px; right: -10px; transform: rotate(10deg);"></div>
                        
                        <!-- Boutons sur le corps -->
                        <div style="position: absolute; width: 20px; height: 20px; background: #F59E0B; border-radius: 50%; bottom: 40px; left: 60px;"></div>
                        <div style="position: absolute; width: 20px; height: 20px; background: #10B981; border-radius: 50%; bottom: 40px; left: 120px;"></div>
                        <div style="position: absolute; width: 20px; height: 20px; background: #EC4899; border-radius: 50%; bottom: 40px; left: 180px;"></div>
                    </div>
                    
                    <!-- Effets lumineux autour du robot -->
                    <div style="position: absolute; width: 50px; height: 50px; background: radial-gradient(circle, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0) 70%); border-radius: 50%; top: 0; right: 40px;"></div>
                    <div style="position: absolute; width: 30px; height: 30px; background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%); border-radius: 50%; top: 80px; left: 20px;"></div>
                    <div style="position: absolute; width: 40px; height: 40px; background: radial-gradient(circle, rgba(156,163,255,0.8) 0%, rgba(156,163,255,0) 70%); border-radius: 50%; bottom: 30px; right: 30px;"></div>
                    
                    <!-- Bulle de dialogue -->
                    <div style="position: absolute; width: 120px; height: 80px; background: white; border-radius: 20px; top: -60px; right: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <div style="position: absolute; width: 20px; height: 20px; background: white; bottom: -10px; right: 20px; transform: rotate(45deg);"></div>
                        <div style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; padding: 10px;">
                            <span style="font-size: 14px; font-weight: bold; color: #4F46E5;">Bonjour, je suis Tako !</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?> 