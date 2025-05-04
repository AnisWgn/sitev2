<!DOCTYPE html>
<html lang="fr">
<head>
    <Title>Contact</Title>
    <meta charset="UTF-8" data-theme="light">
    <script src="Script/script.js" defer></script>
    <link rel="stylesheet" href="Styles/styles.css">
</head>
<body>
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<style>
            .header-page1 {
            padding-left: 15px;
            padding-right: 15px;
            padding-top: 20px;
            padding-bottom: 20px;
            display: inline-block;
            transition: box-shadow 0.5s ease-in-out;
            opacity: 1; /* Empêche toute réduction d'opacité */
            color: var(--header-page-text-color);
        }

            .header-main-page{
            box-shadow:none;
        }

        .main{
            margin-left: 30%;
            margin-right: 30%;
            margin-top:5%;
            box-shadow: var(--login-container-box-shadow);
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 15px;
            padding-bottom: 15px;
            border-radius: 15px;
        }

        h1{
            text-align: center;
            font-size: 40px;
        }

</style>
    <header>
        <button class="header-btn"><img src="image/logo.png" alt="Logo" class="logo" id ="hub-btn"></button>
        <button class="header-btn"><p class="header-page" id ="home-btn">Page d'accueil</p></button>
        <button class="header-btn"><p class="header-page" id ="faq-btn">Question fréquente</p></button>
        <button class="header-btn"><p class="header-page1" id ="contact-btn">Contact</p></button>
        <button class="header-btn"><p class="header-main-page" id ="connexion-btn">Connexion</p></button>
        <button class="account" id="account">
            <dotlottie-player src="https://lottie.host/72051f11-46f8-47cb-b094-3ea2924fcfa4/TwtZwgHEif.lottie" 
            background="transparent" speed="0.5" style="width: 50px; height: 50px"  loop autoplay>
            </dotlottie-player></button>
        <button id ="mode-btn" class="mode" >Mode 🌚</button> 
    </header>
    
    <div class="create-container">
        <div class="main">
            <h1>Création de stage</h1>
            <form action="create2.php" method="POST">
                <div id="div1" class="content">
                    <div class="input-group">
                        <label for="user-name"><strong>Titre</strong></label>
                        <input type="text" id="user-name" name="titre" placeholder="Nom" required>
                    </div>

                    <div class="input-group">
                        <label for="user-email"><strong>Date</strong></label>
                        <input type="date" id="user-email" name="date" placeholder="Email" required>
                    </div>

                    <div class="input-group">
                        <label for="user-password"><strong>Description:</strong></label>
                        <input type="text" id="user-password" name="description" placeholder="Mot de passe" required>
                    </div>

                    <div class="input-group">
                        <label for="user-password"><strong>Type</strong></label>
                        <input type="text" id="user-password" name="type" placeholder="Mot de passe" required>
                    </div>  

                    <div>
                        <input type="checkbox" id="user-confirmation" name="confirmation" checked />
                        <label for="user-confirmation" class="checkbox-label">En créant ce stage vous acceptez notre <a href="Politique_D'utilisation.html" target="_blank"><strong>politique d'utilisation</strong></a>, notre <a href="Politique_de_confidentialité.html" target="_blank"><strong>politique de confidentialité</strong></a> ainsi que notre <a href="Charte_d'utilisation.html" target="_blank"><strong>charte d'utilisation</strong></a></label>
                    </div>

                    <button type="submit" class="login-btn">Créer</button>
                </div>
            </form>
        </div>
        
    </div>