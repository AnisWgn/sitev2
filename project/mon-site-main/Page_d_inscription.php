<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page d'inscription</title>
    <meta charset="UTF-8" data-theme="light">
    <script src="Script/script.js" defer></script>
    <link rel="stylesheet" href="Styles/styles.css">
</head>
<body>
    <style>
        .content {
        display: none;
    }
    </style>
    <script>
         window.onload = function() {
        var divs = document.getElementsByClassName("content");
        for (var i = 0; i < divs.length; i++) {
            divs[i].style.display = "none";
        }
        };

        function showDiv() {
            var selectedValue = document.getElementById("choix").value;
            
            var divs = document.getElementsByClassName("content");
            for (var i = 0; i < divs.length; i++) {
                divs[i].style.display = "none";
            }
            if (selectedValue !== "0") {
                document.getElementById("div" + selectedValue).style.display = "block";
            }
        }
    </script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <header>
        <button class="header-btn"><img src="image/logo.png" alt="Logo" class="logo" id="hub-btn"></button>
        <button class="header-btn"><p class="header-page" id="home-btn">Page d'accueil</p></button>
        <button class="header-btn"><p class="header-page" id="faq-btn">Question fréquente</p></button>
        <button class="header-btn"><p class="header-page" id="contact-btn">Contact</p></button>
        <button class="header-btn"><p class="header-main-page" id="connexion-btn">Connexion</p></button>
        <button class="account" id="account">
            <dotlottie-player src="https://lottie.host/72051f11-46f8-47cb-b094-3ea2924fcfa4/TwtZwgHEif.lottie" 
            background="transparent" speed="0.5" style="width: 50px; height: 50px" loop autoplay>
            </dotlottie-player>
        </button>
        <button id="mode-btn" class="mode">Mode 🌚</button>
    </header>
    <main>
        <div class="login-container">
            <h1 class="login-title">Page d'inscription</h1>
                <select id="choix" class="option-select" onchange="showDiv()">
                    <option value="0">Sélectionnez un type</option>
                    <option value="1">Utilisateur</option>
                    <option value="3">Professeur</option>
                    <option value="2">Entreprise</option>
                </select>
            <form action="register.php" method="POST">
                <div id="div1" class="content">
                    <div class="input-group">
                        <label for="user-name"><strong>Nom :</strong></label>
                        <input type="text" id="user-name" name="username" placeholder="Nom" required>
                    </div>

                    <div class="input-group">
                        <label for="user-email"><strong>Email :</strong></label>
                        <input type="email" id="user-email" name="email" placeholder="Email" required>
                    </div>

                    <div class="input-group">
                        <label for="user-password"><strong>Mot de passe :</strong></label>
                        <input type="password" id="user-password" name="password" placeholder="Mot de passe" required>
                    </div>

                    <div>
                        <input type="checkbox" id="user-confirmation" name="confirmation" checked />
                        <label for="user-confirmation" class="checkbox-label">En vous inscrivant vous acceptez notre <a href="Politique_D'utilisation.html" target="_blank"><strong>politique d'utilisation</strong></a>, notre <a href="Politique_de_confidentialité.html" target="_blank"><strong>politique de confidentialité</strong></a> ainsi que notre <a href="Charte_d'utilisation.html" target="_blank"><strong>charte d'utilisation</strong></a></label>
                    </div>

                    <button type="submit" class="login-btn">S'inscrire</button>
                </div>
            </form>

            <form action="register3.php" method="POST">
                <div id="div2" class="content">
                    <div class="input-group">
                        <label for="company-name"><strong>Nom d'entreprise :</strong></label>
                        <input type="text" id="company-name" name="company-name" placeholder="Nom d'entreprise" required>
                    </div>

                    <div class="input-group">
                        <label for="company-email"><strong>Email :</strong></label>
                        <input type="email" id="company-email" name="email" placeholder="Email" required>
                    </div>

                    <div class="input-group">
                        <label for="siren"><strong>SIREN :</strong></label>
                        <input type="text" id="siren" name="SIREN" placeholder="SIREN" required>
                    </div>

                    <div class="input-group">
                        <label for="company-password"><strong>Mot de passe :</strong></label>
                        <input type="password" id="company-password" name="password" placeholder="Mot de passe" required>
                    </div>

                    <div>
                        <input type="checkbox" id="company-confirmation" name="confirmation" checked />
                        <label for="company-confirmation" class="checkbox-label">En vous inscrivant vous acceptez notre <a href="Politique_D'utilisation.html" target="_blank"><strong>politique d'utilisation</strong></a>, notre <a href="Politique_de_confidentialité.html" target="_blank"><strong>politique de confidentialité</strong></a> ainsi que notre <a href="Charte_d'utilisation.html" target="_blank"><strong>charte d'utilisation</strong></a></label>
                    </div>

                    <button type="submit" class="login-btn">S'inscrire</button>
                </div>
                </form>

                <form action="register2.php" method="POST">
                <div id="div3" class="content">
                    <div class="input-group">
                        <label for="prof-name"><strong>Nom :</strong></label>
                        <input type="text" id="prof-name" name="prof-name" placeholder="Nom" required>
                    </div>

                    <div class="input-group">
                        <label for="prof-email"><strong>Email :</strong></label>
                        <input type="email" id="prof-email" name="email" placeholder="Email" required>
                    </div>

                    <div class="input-group">
                        <label for="prof-email"><strong>Etablissement :</strong></label>
                        <input type="text" id="prof-email" name="Etablissement" placeholder="Etablissement" required>
                    </div>

                    <div class="input-group">
                        <label for="prof-password"><strong>Mot de passe :</strong></label>
                        <input type="password" id="prof-password" name="password" placeholder="Mot de passe" required>
                    </div>

                    <div>
                        <input type="checkbox" id="prof-confirmation" name="confirmation" checked />
                        <label for="prof-confirmation" class="checkbox-label">En vous inscrivant vous acceptez notre <a href="Politique_D'utilisation.html" target="_blank"><strong>politique d'utilisation</strong></a>, notre <a href="Politique_de_confidentialité.html" target="_blank"><strong>politique de confidentialité</strong></a> ainsi que notre <a href="Charte_d'utilisation.html" target="_blank"><strong>charte d'utilisation</strong></a></label>
                    </div>

                    <button type="submit" class="login-btn">S'inscrire</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 ADALG. Tous droits réservés.</p>
    </footer>
</body>
</html>