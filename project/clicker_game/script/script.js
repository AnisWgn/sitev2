        //Game audio
        const upgAudio = new Audio ("audio/coin.mp3");
        const clickAudio = new Audio ("audio/click.mp3")

        // Game state
        let game = {
            points: 0,
            totalPoints: 0,
            totalClicks: 0,
            pointsPerClick: 1,
            pointsPerSecond: 0,
            startTime: new Date(),
            upgrades: [
                {
                    id: 'upgrade1',
                    name: 'Firewall',
                    icon: '🔒',
                    description: 'Améliore les points par clic',
                    basePrice: 10,
                    level: 0,
                    maxLevel: 100,
                    effect: function() { return this.level; },
                    getPriceAtLevel: function(level) {
                        return Math.floor(this.basePrice * Math.pow(1.5, level));
                    }
                },
                {
                    id: 'upgrade2',
                    name: 'Antivirus',
                    icon: '🛡️',
                    description: 'Ajoute des points automatiquement',
                    basePrice: 25,
                    level: 0,
                    maxLevel: 100,
                    effect: function() { return this.level; },
                    getPriceAtLevel: function(level) {
                        return Math.floor(this.basePrice * Math.pow(1.8, level));
                    }
                },
                {
                    id: 'upgrade3',
                    name: 'VPN',
                    icon: '🔐',
                    description: 'Multiplie tous les points gagnés',
                    basePrice: 100,
                    level: 0,
                    maxLevel: 100,
                    effect: function() { return 1 + (this.level * 0.2); },
                    getPriceAtLevel: function(level) {
                        return Math.floor(this.basePrice * Math.pow(2.2, level));
                    }
                },
                {
                    id: 'upgrade4',
                    name: 'Authentification 2FA',
                    icon: '🔑',
                    description: 'Double chaque Xème clic',
                    basePrice: 200,
                    level: 0,
                    maxLevel: 100,
                    effect: function() { return this.level > 0 ? 10 - (this.level * 2) : 0; },
                    getPriceAtLevel: function(level) {
                        return Math.floor(this.basePrice * Math.pow(3, level));
                    }
                },
                {
                    id: 'upgrade5',
                    name: 'Clé publique',
                    icon: '🔓',
                    description: 'Améliore les points par cliques',
                    basePrice: 1000,
                    level: 0,
                    maxLevel: 100,
                    effect: function() { return this.level; },
                    getPriceAtLevel: function(level) {
                        return Math.floor(this.basePrice * Math.pow(3, level));
                    }
                },
                {
                    id: 'upgrade6',
                    name: 'Clé privée',
                    icon: '🔒',
                    description: 'Améliore tous les points gagnés',
                    basePrice: 5000,
                    level: 0,
                    maxLevel: 100,
                    effect: function() { return this.level; },
                    getPriceAtLevel: function(level) {
                        return Math.floor(this.basePrice * Math.pow(4, level));
                    }
                }
            ],
            achievements: [
                {
                    id: 'achievement1',
                    name: 'Débutant en cybersécurité',
                    description: 'Atteindre 100 points',
                    icon: '👶',
                    unlocked: false,
                    check: function() { return game.points >= 100; }
                },
                {
                    id: 'achievement2',
                    name: 'Technicien sécurité',
                    description: 'Atteindre 1 000 points',
                    icon: '👨‍💻',
                    unlocked: false,
                    check: function() { return game.points >= 1000; }
                },
                {
                    id: 'achievement3',
                    name: 'Expert en cybersécurité',
                    description: 'Atteindre 10 000 points',
                    icon: '🛡️',
                    unlocked: false,
                    check: function() { return game.points >= 10000; }
                },
                {
                    id: 'achievement4',
                    name: 'Cybersécurité',
                    description: 'Atteindre 100 000 points',
                    icon: '🥷',
                    unlocked: false,
                    check: function() { return game.points >= 100000; }
                },
                {
                    id: 'achievement5',
                    name: 'Hacker',
                    description: 'Atteindre 1 000 000 points',
                    icon: '🧢',
                    unlocked: false,
                    check: function() { return game.points >= 1000000; }
                },
                {
                    id: 'achievement6',
                    name: 'Clic-mania',
                    description: 'Cliquer 100 fois',
                    icon: '👆',
                    unlocked: false,
                    check: function() { return game.totalClicks >= 100; }
                },
                {
                    id: 'achievement7',
                    name: 'Clicker pro',
                    description: 'Cliquer 1000 fois',
                    icon: '🎮',
                    unlocked: false,
                    check: function() { return game.totalClicks >= 1000; }
                },
                {
                    id: 'achievement8',
                    name: 'Clicker originel',
                    description: 'Cliquer 10000 fois',
                    icon: '1️⃣',
                    unlocked: false,
                    check: function() { return game.totalClicks >= 10000; }
                },
                {
                    id: 'achievement9',
                    name: 'Clicker fou',
                    description: 'Cliquer 100000 fois',
                    icon: '💥',
                    unlocked: false,
                    check: function() { return game.totalClicks >= 100000; }
                },
                {
                    id: 'achievement10',
                    name: 'TSB',
                    description: 'Cliquer 1000000 fois',
                    icon: '🌿',
                    unlocked: false,
                    check: function() { return game.totalClicks >= 1000000; }
                },
                {
                    id: 'achievement11',
                    name: 'Maximiseur',
                    description: 'Acheter toutes les améliorations au moins une fois',
                    icon: '🌟',
                    unlocked: false,
                    check: function() { return game.upgrades.every(upgrade => upgrade.level > 0); }
                },
                {
                    id: 'achievement12',
                    name: '?????',
                    description: 'Comment????',
                    icon: '❓',
                    unlocked: false,
                    check: function() { return game.totalClick >=1000000000; }
                }
            ]
        };
        
        // DOM Elements
        const pointsDisplay = document.getElementById('points');
        const pointsContainer = document.getElementById('points-container');
        const pointsPerSecondDisplay = document.getElementById('points-per-second');
        const pointsPerClickDisplay = document.getElementById('points-per-click');
        const totalClicksDisplay = document.getElementById('total-clicks');
        const totalScoreDisplay = document.getElementById('total-score');
        const playTimeDisplay = document.getElementById('play-time');
        const clickButton = document.getElementById('clickBtn');
        const pulseRing = document.getElementById('pulseRing');
        const upgradesContainer = document.getElementById('upgradesContainer');
        const achievementsContainer = document.getElementById('achievements');
        const notificationContainer = document.getElementById('notification-container');
        
        // Initialize the game
        function initGame() {
            renderUpgrades();
            renderAchievements();
            updateStats();
            
            // Add background particles
            addBackgroundParticles();
            
            // Start automatic point generation and updates
            setInterval(autoGenerate, 1000);
            setInterval(updatePlayTime, 1000);
            setInterval(checkAchievements, 2000);
            
            // Event listeners
            clickButton.addEventListener('click', handleClick);
            clickButton.addEventListener('mousedown', function() {
                clickButton.style.transform = 'scale(0.95)';
            });
            clickButton.addEventListener('mouseup', function() {
                clickButton.style.transform = 'scale(1)';
            });
        }
        
        // Add background particles
        function addBackgroundParticles() {
            const colors = ['#4cc9f0', '#4361ee', '#f72585'];
            
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 5 + 1;
                const color = colors[Math.floor(Math.random() * colors.length)];
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.backgroundColor = color;
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.top = `${Math.random() * 100}vh`;
                particle.style.opacity = Math.random() * 0.5 + 0.3;
                
                document.body.appendChild(particle);
                
                // Animate particles
                animateParticle(particle);
            }
        }
        
        // Animate particles
        function animateParticle(particle) {
            const duration = Math.random() * 50 + 30;
            particle.style.transition = `top ${duration}s linear, left ${duration}s linear`;
            
            setTimeout(() => {
                particle.style.top = `${Math.random() * 100}vh`;
                particle.style.left = `${Math.random() * 100}vw`;
                
                // Recursive call to keep animation going
                animateParticle(particle);
            }, 100);
        }
        
        // Handle click on the main button
        function handleClick() {
            game.totalClicks++;

            //PLay clickAudio
            clickAudio.playbackRate = 4; //Vitesse de lecture du fichier audio
            clickAudio.currentTime = 0;
            clickAudio.play();

            // Create pulse ring animation
            const newPulseRing = document.createElement('div');
            newPulseRing.className = 'pulse-ring pulsing-ring';
            clickButton.parentElement.appendChild(newPulseRing);
            
            // Remove pulse ring after animation
            setTimeout(() => {
                clickButton.parentElement.removeChild(newPulseRing);
            }, 1500);
            
            // Calculate points to add
            let pointsToAdd = game.pointsPerClick;
            
            // Check for 2FA upgrade (double points on every Xth click)
            const doubleFactor = game.upgrades[3].effect();
            if (doubleFactor > 0 && game.totalClicks % doubleFactor === 0) {
                pointsToAdd *= 2;
                showFloatingText('DOUBLE!', clickButton, '#ffd700');
                showNotification('Double Points!', 'Vous avez obtenu un bonus de double points!', 'upgrade');
            }
            
            // Apply VPN multiplier
            pointsToAdd *= game.upgrades[2].effect();
            
            // Add points
            addPoints(pointsToAdd);
            
            // Create floating text for points
            showFloatingText(`+${pointsToAdd.toFixed(1)}`, clickButton, '#4cc9f0');
            
            // Update stats
            updateStats();
        }
        
        // Add points to the game
        function addPoints(amount) {
            game.points += amount;
            game.totalPoints += amount;
            
            // Update display with animation
            pointsDisplay.textContent = Math.floor(game.points);
            pointsContainer.classList.add('score-changed');
            
            // Remove animation class after animation completes
            setTimeout(() => {
                pointsContainer.classList.remove('score-changed');
            }, 500);
            
            // Update upgrade buttons (some might become available)
            updateUpgradeButtons();
        }
        
        // Show floating text (for click points)
        function showFloatingText(text, targetElement, color = '#4cc9f0') {
            const floatingText = document.createElement('div');
            floatingText.className = 'floating-text';
            floatingText.textContent = text;
            floatingText.style.color = color;
            
            // Position the text at a random offset from the click
            const offsetX = Math.random() * 40 - 20;
            const rect = targetElement.getBoundingClientRect();
            
            floatingText.style.left = `${rect.left + rect.width / 2 + offsetX}px`;
            floatingText.style.top = `${rect.top + rect.height / 2}px`;
            
            document.body.appendChild(floatingText);
            
            // Remove the element after animation completes
            setTimeout(() => {
                document.body.removeChild(floatingText);
            }, 1500);
        }
        
        // Automatically generate points based on upgrades
        function autoGenerate() {
            if (game.pointsPerSecond > 0) {
                addPoints(game.pointsPerSecond);
            }
        }
        
        // Update game statistics
        function updateStats() {
            // Calculate points per click
            game.pointsPerClick = 1 + game.upgrades[0].effect();
            game.pointsPerClick *= game.upgrades[2].effect();
            
            // Calculate points per second
            game.pointsPerSecond = game.upgrades[1].effect();
            game.pointsPerSecond *= game.upgrades[2].effect();
            
            // Update displays
            pointsDisplay.textContent = Math.floor(game.points);
            pointsPerSecondDisplay.textContent = game.pointsPerSecond.toFixed(1);
            pointsPerClickDisplay.textContent = game.pointsPerClick.toFixed(1);
            totalClicksDisplay.textContent = game.totalClicks;
            totalScoreDisplay.textContent = Math.floor(game.totalPoints);
            
            updateUpgradeButtons();
        }
        
        // Update play time display
        function updatePlayTime() {
            const now = new Date();
            const diff = Math.floor((now - game.startTime) / 1000);
            const minutes = Math.floor(diff / 60).toString().padStart(2, '0');
            const seconds = (diff % 60).toString().padStart(2, '0');
            playTimeDisplay.textContent = `${minutes}:${seconds}`;
        }
        
        // Render all upgrades
        function renderUpgrades() {
            upgradesContainer.innerHTML = '';
            
            game.upgrades.forEach(upgrade => {
                const upgradeElement = createUpgradeElement(upgrade);
                upgradesContainer.appendChild(upgradeElement);
            });
        }
        
        // Create an upgrade element
        function createUpgradeElement(upgrade) {
            const upgradeElement = document.createElement('div');
            upgradeElement.className = 'upgrade-item';
            upgradeElement.id = upgrade.id;
            
            const currentPrice = upgrade.getPriceAtLevel(upgrade.level);
            const nextLevel = upgrade.level + 1;
            const isMaxed = upgrade.level >= upgrade.maxLevel;
            
            let effectText = '';
            let effectValue = '';
            
            // Different text based on upgrade type
            switch(upgrade.id) {
                case 'upgrade1':
                    effectText = 'Points par clic';
                    effectValue = '+' + upgrade.level;
                    break;
                case 'upgrade2':
                    effectText = 'Points auto.';
                    effectValue = upgrade.level + '/s';
                    break;
                case 'upgrade3':
                    effectText = 'Multiplicateur';
                    effectValue = 'x' + upgrade.effect().toFixed(1);
                    break;
                case 'upgrade4':
                    effectText = 'Double tous les';
                    effectValue = upgrade.effect() > 0 ? upgrade.effect() + ' clics' : '-';
                    break;
                case 'upgrade5':
                    effectText = 'Points par clic';
                    effectValue = '+' + upgrade.level;
                    break;
                case 'upgrade6':
                    effectText = 'Multiplicateur totaux';
                    effectValue = 'x' + upgrade.effect().toFixed(1);
                    break;
            }
            
            upgradeElement.innerHTML = `
                <div class="upgrade-icon">${upgrade.icon}</div>
                <h3>${upgrade.name}</h3>
                <div class="upgrade-details">
                    <div class="upgrade-description">${upgrade.description}</div>
                    <div class="upgrade-stats">
                        <span class="upgrade-level">Niveau ${upgrade.level}${isMaxed ? ' (MAX)' : ''}</span>
                        <span class="upgrade-effect">${effectText}: ${effectValue}</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: ${(upgrade.level / upgrade.maxLevel) * 100}%"></div>
                    </div>
                </div>
                <div class="upgrade-price">${isMaxed ? 'MAX' : currentPrice + ' points'}</div>
                <button class="upgrade-button ${isMaxed ? 'max-level' : ''}" 
                    ${isMaxed || currentPrice > game.points ? 'disabled' : ''} 
                    onclick="purchaseUpgrade('${upgrade.id}')">
                    ${isMaxed ? 'MAXIMUM' : 'AMÉLIORER'}
                </button>
            `;
            
            return upgradeElement;
        }
        
        // Update upgrade buttons (enable/disable based on available points)
        function updateUpgradeButtons() {
            game.upgrades.forEach(upgrade => {
                const upgradeButton = document.querySelector(`#${upgrade.id} .upgrade-button`);
                if (!upgradeButton) return;
                
                if (upgrade.level >= upgrade.maxLevel) {
                    upgradeButton.disabled = true;
                    upgradeButton.classList.add('max-level');
                    upgradeButton.textContent = 'MAXIMUM';
                } else {
                    const price = upgrade.getPriceAtLevel(upgrade.level);
                    upgradeButton.disabled = price > game.points;
                }
            });
        }
        
        // Purchase an upgrade
        function purchaseUpgrade(upgradeId) {
            const upgrade = game.upgrades.find(u => u.id === upgradeId);
            if (!upgrade) return;
            
            const price = upgrade.getPriceAtLevel(upgrade.level);
            
            if (game.points >= price && upgrade.level < upgrade.maxLevel) {
                // Deduct points
                game.points -= price;
                
                // Increase level
                upgrade.level++;
                
                // Update stats
                updateStats();

                //Play upgAudio
                upgAudio.playbackRate = 1.5;
                upgAudio.currentTime = 0;
                upgAudio.play();
                
                // Recreate the upgrade element
                const oldElement = document.getElementById(upgradeId);
                const newElement = createUpgradeElement(upgrade);
                oldElement.parentNode.replaceChild(newElement, oldElement);
                
                // Show notification
                showNotification(
                    `${upgrade.name} amélioré!`, 
                    `Niveau ${upgrade.level}/${upgrade.maxLevel} débloqué.`, 
                    'upgrade'
                );
                
                // Check achievements
                checkAchievements();
            }
        }
        
        // Render all achievements
        function renderAchievements() {
            achievementsContainer.innerHTML = '<h2 class="section-title">Réussites</h2>';
            
            game.achievements.forEach(achievement => {
                const achievementElement = document.createElement('div');
                achievementElement.className = `achievement ${achievement.unlocked ? 'unlocked' : ''}`;
                achievementElement.id = achievement.id;
                
                achievementElement.innerHTML = `
                    <div class="achievement-icon">${achievement.icon}</div>
                    <div class="achievement-content">
                        <div class="achievement-title">${achievement.name}</div>
                        <div class="achievement-description">${achievement.description}</div>
                    </div>
                `;
                
                achievementsContainer.appendChild(achievementElement);
            });
        }
        
        // Check for unlocked achievements
        function checkAchievements() {
            game.achievements.forEach(achievement => {
                if (!achievement.unlocked && achievement.check()) {
                    // Unlock achievement
                    achievement.unlocked = true;
                    
                    // Show achievement
                    const achievementElement = document.getElementById(achievement.id);
                    if (achievementElement) {
                        achievementElement.classList.add('unlocked');
                    }
                    
                    // Show notification
                    showNotification(
                        'Réussite Débloquée!', 
                        achievement.name, 
                        'achievement'
                    );
                }
            });
        }
        
        // Show notification
        function showNotification(title, message, type = 'default') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            let icon = '🔔';
            if (type === 'achievement') icon = '🏆';
            if (type === 'upgrade') icon = '⬆️';
            
            notification.innerHTML = `
                <div class="notification-icon">${icon}</div>
                <div class="notification-content">
                    <div class="notification-title">${title}</div>
                    <div class="notification-message">${message}</div>
                </div>
            `;
            
            notificationContainer.appendChild(notification);
            
            // Remove notification after 5 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s forwards';
                setTimeout(() => {
                    notificationContainer.removeChild(notification);
                }, 300);
            }, 5000);
        }
        
        // Make functions available globally for the onclick handlers
        window.purchaseUpgrade = purchaseUpgrade;
        
        // Initialize the game
        document.addEventListener('DOMContentLoaded', initGame);