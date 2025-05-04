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
        <button class="header-btn"><p class="header-page" id ="contact-btn" href="contact.php">Contact</p></button>
        <button class="header-btn"><p class="header-main-page" id ="connexion-btn">Connexion</p></button>
        <button id ="mode-btn" class="mode" >Mode 🌚</button>
    </header>
    <main>
        <div class="login-container">
            <dotlottie-player src="https://lottie.host/a6fed922-3f61-481e-bd6b-db578bd311c1/ROKqhj53FK.lottie" 
            background="transparent" speed="1" style="width: 150px; height: 150px" loop autoplay>
            </dotlottie-player>
            <form  action="login.php" method="POST">
                <div class="input-group">
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" id="username" name="email" placeholder="Email"required>
                </div>

                <div class="input-group">
                    <label for="password"><strong>Mot de passe:</strong></label>
                    <input type="password" id="password" name="password" placeholder="Mot de passe"required>
                </div>

                <button type="submit" class="login-btn">Se connecter</button>
            </form>
            <button class="register-btn" onclick="window.location.href='Page_d_inscription.php'">S'inscrire</button>


                <div class="forgot-password">
                    <a href="Mot_De_Passe_Oublié.html" class="forgot-password" id="forgot-password">
                        Mot de passe oublié ?</a>
                </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 ADALG. Tous droits réservés.</p>
    </footer>
</body>