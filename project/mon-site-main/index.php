<!DOCTYPE html>
<html lang="fr">
<head>
    <Title>Page de connexion</Title>
    <meta charset="UTF-8" data-theme="light">
    <script src="Script/script.js" defer></script>
    <link rel="stylesheet" href="Styles/styles.css">
</head>
<body>
    <script src="server.js" defer></script>
    <script src="count.js" defer></script>
    <style>

        .header-main-page{
            box-shadow:none;
        }
        .header-page1 {
        padding-left: 15px;
        padding-right: 15px;
        padding-top: 20px;
        padding-bottom: 20px;
        display: inline-block;
        transition: box-shadow 0.5s ease-in-out;
        opacity: 1; /* Empêche toute réduction d'opacité */
        color: var(--header-page-text-color);
        box-shadow:0px 2px 0px 0px
        }
            
    </style>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <header>
        <button class="header-btn"><img src="image/logo.png" alt="Logo" class="logo" id ="hub-btn"></button>
        <button class="header-btn"><p class="header-page" id ="home-btn">Page d'accueil</p></button>
        <button class="header-btn"><p class="header-page" id="faq-btn">Question fréquente</p></button>
        <button class="header-btn"><p class="header-page" id ="contact-btn" href="contact.php">Contact</p></button>
        <button class="header-btn"><p class="header-main-page" id ="connexion-btn">Connexion</p></button>
        <button class="account" id="account">
            <dotlottie-player src="https://lottie.host/72051f11-46f8-47cb-b094-3ea2924fcfa4/TwtZwgHEif.lottie" 
            background="transparent" speed="0.5" style="width: 50px; height: 50px"  loop autoplay>
            </dotlottie-player></button>
        <button id ="mode-btn" class="mode" >Mode 🌚</button>
    </header>
    <main>
        <div class="prez">
            <div class="prez div">      
                <h1>Qui sommes nous ?</h1>
                <p>Nous somme un groupe de quatres étudiant du BTS SIO au lycée Chopin.</p>
            </div> 
            <div class="prez div"> 
                <h1>Pourquoi avoir fait ce site ?</h1>
                <p>Le site ADALG est né de la "semaine de challenge" organisée par notre lycée.</p>
                <p>Il a pour but de créer un espace d'interconnection entre étudiants en recherche de stage et entreprises en recherhce de stagiaires tout cela sous la suppervision de professeurs.</p>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 ADALG. Tous droits réservés.</p>
    </footer>
</body>