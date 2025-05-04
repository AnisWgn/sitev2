<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: Page_De_Connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <Title>Page de connexion</Title>
    <meta charset="UTF-8" data-theme="light">
    <script src="Script/script.js" defer></script>
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="icon" type="image/x-icon" href="image/logo.png">
</head>
<body>
    <style>
        .header-main-page{
            text-decoration: none;
    }
    </style>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <header>
        <button class="header-btn"><img src="image/logo.png" alt="Logo" class="logo" id ="hub-btn"></button>
        <button class="header-btn"><p class="header-page" id ="home-btn">Page d'accueil</p></button>
        <button class="header-btn"><p class="header-page" id ="faq-btn">Question fréquente</p></button>
        <button class="header-btn"><p class="header-page" id ="contact-btn" href="contact.php">Contact</p></button>
        <button class="header-btn"><p class="header-main-page" id ="connexion-btn">Connexion</p></button>
        <button class="account" id="account">
            <dotlottie-player src="https://lottie.host/72051f11-46f8-47cb-b094-3ea2924fcfa4/TwtZwgHEif.lottie" 
            background="transparent" speed="0.5" style="width: 50px; height: 50px"  loop autoplay>
            </dotlottie-player></button>
        <button id ="mode-btn" class="mode" >Mode 🌚</button>
    </header>
    <main>
        <p></p>
        <div class="login-container">
            <h1 class="login-title">Modification du compte</h1>
            <form  action="register.php" method="POST">
                <div class="input-group">
                    <label for="username"><strong>Nom :</strong></label>
                    <input type="text" id="username" name="username" placeholder="Nom">
                </div>

                <div class="input-group">
                    <label for="email"><strong>email</strong></label>
                    <input type="email" id="Gmail" name="email" placeholder="email">
                </div>

                <div class="input-group">
                    <label for="password"><strong>Mot de passe :</strong></label>
                    <input type="password" id="password" name="password" placeholder="Mot de passe">
                </div>

                <div class="input-group">
                    <label for="confirm-password"><strong>Confirmez le mot de passe :</strong></label>
                     <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez le mot de passe">
                </div>

                <button type="submit" class="login-btn">Valider les modifications</button>

                <a href="logout.php" class="input-btn">Se deconnecter</a>
            </form>
        </div>
    </main>
</body>
