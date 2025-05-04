<!DOCTYPE html>
<html lang="fr">
<head>
    <Title>Page de connexion</Title>
    <meta charset="UTF-8" data-theme="light">
    <script src="Script/script.js" defer></script>
    <link rel="stylesheet" href="Styles/styles.css">
</head>
<body>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <header>
        <button class="header-btn"><img src="image/logo.png" alt="Logo" class="logo" id ="hub-btn"></button>
        <button class="header-btn"><p class="header-page" id ="home-btn">Page d'accueil</p></button>
        <button class="header-btn"><p class="header-page" id ="faq-btn">Question fréquente</p></button>
        <button class="header-btn"><p class="header-page" id ="contact-btn">Contact</p></button>
        <button class="header-btn"><p class="header-main-page" id ="connexion-btn">Connexion</p></button>
        <dotlottie-player src="https://lottie.host/95785f1b-5a37-4ec5-945a-a00f85032478/TmPkyyjm2k.lottie" 
            background="transparent" speed="1" style="width: 70px; height: 70px" loop autoplay>
        </dotlottie-player>
        <button id ="mode-btn" class="mode" >Mode 🌚</button>
    </header>
    <main>
        <div class="login-container">
            <h1 class="login-title">Page de connexion</h1>
            <form  action="" method="POST">
                <div class="input-group">
                    <label for="name" placeholder="Identifiant ou email"><strong>Nom :</strong></label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="input-group">
                    <label for="username"><strong>Prénom :</strong></label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="input-group">
                    <label for="Gmail"><strong>Gmail</strong></label>
                    <input type="text" id="Gmail" name="Gmail" required>
                </div>

                <div class="input-group">
                    <label for="password"><strong>Mot de passe :</strong></label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="login-btn">Se connecter</button>
                <button class="register-btn">S'inscrire</button>

                <div class="forgot-password">
                    <a href="Mot_De_Passe_Oublié.html" class="forgot-password" id="forgot-password">
                        Mot de passe oublié ?</a>
                </div>
            </form>
        </div>
    </main>
    <script>
        mail=document.getElementById("Gmail");
        if(mail.value.includes("@gmail.com")) {
        }
        else {
            alert("Veuillez entrer un Gmail valide");
        }
    </script>
    <footer>
        <p>&copy; 2025 ADALG. Tous droits réservés.</p>
    </footer>
</body>