document.addEventListener("DOMContentLoaded", function () {
    const modeBtn = document.getElementById("mode-btn");
    const themes = ["light", "dark"]; // Liste des thèmes disponibles
    let currentThemeIndex = localStorage.getItem('themeIndex') || 0; // Index du thème actuel

    // Application du thème initial
    setTheme(themes[currentThemeIndex]);

    modeBtn.addEventListener("click", () => {

        currentThemeIndex = (currentThemeIndex + 1) % themes.length;
        const newTheme = themes[currentThemeIndex];
        
        setTheme(newTheme);
        
        localStorage.setItem('themeIndex', currentThemeIndex);
    });

    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        updateButtonText(theme);
    }

    function updateButtonText(theme) {
        // Update the button text based on the current theme
        const themeIcons = {
            light: "🌞",
            dark: "🌚",
        };
        modeBtn.textContent = `Mode ${themeIcons[theme]}`;
    }

    const navigationButtons = [
        { id: "hub-btn", url: "index.php" },
        { id: "home-btn", url: "Hub.php" },
        { id: "faq-btn", url: "FAQ.html" },
        { id: "question-btn", url: "question.html" },
        { id: "contact-btn", url: "contact.php" },
        { id: "connexion-btn", url: "Page_De_Connexion.php" },
        { id: "inscription-btn", url: "Page_Inscription.html" },
        { id: "account", url: "option_profile.php" },
        { id: "create", url: "create.php"},
        { id: "forgot-password", url: "Mot_de_Passe_oublié.html" }
    ];

    navigationButtons.forEach(({ id, url }) => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener("click", () => window.location.href = url);
        }
    });

    const form = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');

    if (form) {
        form.addEventListener('submit', function(event) {
            const errorMessage = document.getElementById('password-error');

            if (passwordInput.value !== confirmPasswordInput.value) {
                event.preventDefault();

                if (errorMessage) {
                    errorMessage.style.display = 'block';
                } else {
                    alert('Les mots de passe ne sont pas identiques. Veuillez réessayer.');
                }
            }
        });
    }
});