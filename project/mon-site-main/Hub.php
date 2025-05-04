<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "adalg");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupérer les publications depuis la base de données
$sql = "SELECT titre, description, filiere, date_parution FROM publications ORDER BY date_parution DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <Title>Page de connexion</Title>
    <meta charset="UTF-8" data-theme="light">
    <script src="Script/script.js" defer></script>
    <link rel="stylesheet" href="Styles/styles.css">
</head>
<body>
    <style>

        .button-86 {
            all: unset;
            width: 100px;
            height: 30px;
            font-size: 16px;
            background: transparent;
            border: none;
            position: relative;
            color: #f0f0f0;
            cursor: pointer;
            z-index: 1;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            margin-bottom: 10px;
            margin-left: 5px;
        }

        .button-86::after,
        .button-86::before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            z-index: -99999;
            transition: all .4s;
        }

        .button-86::before {
            transform: translate(0%, 0%);
            width: 100%;
            height: 100%;
            background: #28282d;
            border-radius: 10px;
        }

        .button-86::after {
            transform: translate(10px, 10px);
            width: 35px;
            height: 35px;
            background: #ffffff15;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border-radius: 50px;
            
        }

        .button-86:hover::before {
            transform: translate(5%, 20%);
            width: 110%;
            height: 110%;
        }

        .button-86:hover::after {
            border-radius: 10px;
            transform: translate(0, 0);
            width: 100%;
            height: 100%;
        }

        .button-86:active::after {
            transition: 0s;
            transform: translate(0, 5%);
        }   
        

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
            box-shadow:0px 2px 0px 0px var(--header-page-hover-box-shadow);
    }
        .offers-title {
            color: var(--offer-title-color);
            display: flex;
            justify-content: center;
        }
        .offer h2{
            color: var(--offer-color-h2)
        }
        .offer strong {
            color: var(--offer-color-strong)
        }
        .offer {
            margin: 0px 0px 20px;
            padding: 10px;
            border-radius: 15px;
            box-shadow: var(--login-container-box-shadow);
        }

        .create{
            border-top-left-radius:15px ;
            border-bottom-right-radius: 15px;
            background-color: var(--mode-bg-color);
            border :var(--mode-border);
            color:var(--mode-text-color);
            cursor: pointer;
            margin-left: 10px;
            font-size: 15px;
            padding:10px;
        }

        .create:hover{
            border : var(--mode-hover-border);
        }

        .create-text{
            text-decoration: none;
            font-size: 20px;
            color: var(--mode-text-color);
        }

        .offers-container{
            width: 40%;
            font-family: 20px;
        }

        .offer{
            font-size:20px ;
            text-align: left;
            padding-left:20px;
        }

    </style>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <header>
        <button class="header-btn"><img src="image/logo.png" alt="Logo" class="logo" id ="hub-btn"></button>
        <button class="header-btn"><p class="header-page1" id ="home-btn">Page d'accueil</p></button>
        <button class="header-btn"><p class="header-page" id ="faq-btn">Question fréquente</p></button>
        <button class="header-btn"><p class="header-page" id ="contact-btn" href="contact.php">Contact</p></button>
        <button class="header-btn"><p class="header-main-page" id ="connexion-btn">Connexion</p></button>
        <button class="create"><a class="create-text" id="create" href="create.php">Créer un stage</a></button>
        <button class="account" id="account">
            <dotlottie-player src="https://lottie.host/72051f11-46f8-47cb-b094-3ea2924fcfa4/TwtZwgHEif.lottie" 
            background="transparent" speed="0.5" style="width: 50px; height: 50px"  loop autoplay>
            </dotlottie-player></button>
        <button id ="mode-btn" class="mode" >Mode 🌚</button>
    </header>
    <main>
    <div class="offers-container">
        <h1 class="offers-title">Offres de Stages</h1>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="offer">';
                echo '<h2>' . htmlspecialchars($row["titre"]) . '</h2>';
                echo '<p><strong>Filière :</strong> ' . htmlspecialchars($row["filiere"]) . '</p>';
                echo '<p><strong>Date :</strong> ' . htmlspecialchars($row["date_parution"]) . '</p>';
                echo '<p><strong>Description :</strong> ' . htmlspecialchars($row["description"]) . '</p>';
                echo '<button class="button-86" role="button">Postuler</button>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucune offre de stage disponible.</p>';
        }

        // Fermer la connexion
        $conn->close();
        ?>
    </div>
</main>
    <footer>
        <p>&copy; 2025 ADALG. Tous droits réservés.</p>
    </footer>
</body>