<!DOCTYPE html>
<html lang="fr">
<head>
    <Title>Contact</Title>
    <meta charset="UTF-8" data-theme="light">
    <script src="Script/script.js" defer></script>
    <link rel="stylesheet" href="Styles/styles.css">
</head>
<body>
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
            box-shadow:0px 2px 0px 0px var(--header-page-hover-box-shadow);
        }

            .header-main-page{
            box-shadow:none;
        }
    </style>
    <header>
        <button class="header-btn"><img src="image/logo.png" alt="Logo" class="logo" id ="hub-btn"></button>
        <button class="header-btn"><p class="header-page" id ="home-btn">Page d'accueil</p></button>
        <button class="header-btn"><p class="header-page" id ="faq-btn">Question fréquente</p></button>
        <button class="header-btn"><p class="header-page1" id ="contact-btn">Contact</p></button>
        <button class="header-btn"><p class="header-main-page" id ="connexion-btn">Connexion</p></button>
        <button id ="mode-btn" class="mode" >Mode 🌚</button>       
    </header>  
    <main>
        <div class="contact-container">
            <h1 class="login-title">Nous contacter</h1>
            <p class="contact"><a href="mailto:adalg.contact@gmail.com" class="contact"> adalg.contact@gmail.com </a></p>
            <p class="contact"><a href="tel:03 83 40 85 31" class="contact"> 03 83 40 85 31 </a></p>
            <p class="contact"> 39 rue du Sergent Blandan</p>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 ADALG. Tous droits réservés.</p>
    </footer>
</body>
</html>