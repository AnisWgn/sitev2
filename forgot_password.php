<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération de mot de passe - Mon Portfolio</title>
    <link rel="stylesheet" href="/portfolio/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="/portfolio/image/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .recovery-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: var(--secondary-color);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .recovery-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .recovery-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .input-with-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-with-icon i {
            position: absolute;
            left: 1rem;
            color: var(--text-color);
        }

        .input-with-icon input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: var(--primary-color);
            border: 2px solid var(--accent-color);
            border-radius: 10px;
            color: var(--text-color);
            font-size: 1rem;
        }

        .send-button {
            padding: 1rem;
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .send-button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px var(--accent-color);
        }

        .troll-container {
            display: none;
            text-align: center;
            padding: 2rem;
            animation: shake 0.5s infinite;
        }
        
        .troll-message {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 2rem;
        }
        
        .troll-image {
            max-width: 300px;
            margin: 2rem auto;
            border-radius: 15px;
            box-shadow: 0 0 20px var(--accent-color);
        }
        
        .troll-button {
            padding: 1rem 2rem;
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 2rem;
        }
        
        .troll-button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px var(--accent-color);
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .moving-button {
            position: absolute;
            transition: all 0.1s ease;
        }

        .progress-text {
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--accent-color);
            transition: all 0.3s ease;
        }

        .progress-text:hover {
            transform: scale(1.05);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="theme-menu">
        <button class="theme-btn" id="theme-toggle">
            <i class="fas fa-moon"></i>
            <span>Thème</span>
        </button>
    </div>

    <div class="login-container">
        <div class="recovery-container" id="recoveryForm">
            <div class="recovery-header">
                <h1>Récupération de mot de passe</h1>
                <p>Entrez votre adresse email pour recevoir un lien de réinitialisation</p>
            </div>
            
            <p class="progress-text" id="progressText">Cliquez sur le bouton pour commencer la récupération</p>
            
            <form class="recovery-form" id="passwordRecoveryForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <button type="submit" class="send-button" id="sendButton">
                    <i class="fas fa-paper-plane"></i>
                    Envoyer le lien
                </button>
            </form>
        </div>

        <div class="troll-container" id="trollContent">
            <h1 class="troll-message">🤣 Tu t'es fait avoir ! 🤣</h1>
            <img src="https://media.giphy.com/media/3o7aCTPPm4OHfRLSH6/giphy.gif" alt="Troll Face" class="troll-image">
            <p style="font-size: 1.5rem; margin: 2rem 0;">Désolé, mais il n'y a pas de récupération de mot de passe ici !</p>
            <button class="troll-button" onclick="window.location.href='login.php'">
                <i class="fas fa-arrow-left"></i> Retour à la connexion
            </button>
        </div>
    </div>

    <script>
        // Gestion du thème
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            const html = document.documentElement;
            const icon = themeToggle.querySelector('i');
            
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                html.setAttribute('data-theme', savedTheme);
                updateThemeIcon(savedTheme);
            }

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

            // Gestion du bouton qui bouge et du texte de progression
            const progressTexts = [
                "Cliquez sur le bouton pour commencer la récupération",
                "Encore un peu...",
                "Presque là...",
                "Encore quelques clics...",
                "Ça y est presque...",
                "Plus que quelques-uns...",
                "Encore un petit effort...",
                "Presque au bout...",
                "Encore un tout petit peu...",
                "Dernier clic...",
                "Bonne chance !"
            ];

            const sendButton = document.getElementById('sendButton');
            const recoveryForm = document.getElementById('recoveryForm');
            const trollContent = document.getElementById('trollContent');
            const progressText = document.getElementById('progressText');
            let moveCount = 0;
            const minMoves = 10;
            let hasWon = false;

            document.getElementById('passwordRecoveryForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!hasWon) {
                    // Mettre à jour le texte de progression
                    progressText.textContent = progressTexts[Math.min(moveCount, progressTexts.length - 1)];
                    
                    // Faire bouger le bouton
                    const x = Math.random() * (window.innerWidth - 200);
                    const y = Math.random() * (window.innerHeight - 100);
                    sendButton.style.position = 'absolute';
                    sendButton.style.left = x + 'px';
                    sendButton.style.top = y + 'px';
                    
                    moveCount++;
                    
                    // Après 10 clics, une chance sur 10 de gagner
                    if (moveCount >= minMoves) {
                        const randomChance = Math.random();
                        if (randomChance < 0.1) { // 10% de chance
                            hasWon = true;
                            // Afficher le contenu troll
                            recoveryForm.style.display = 'none';
                            trollContent.style.display = 'block';
                        }
                    }
                }
            });
        });
    </script>
</body>
</html> 