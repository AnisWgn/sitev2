document.addEventListener("DOMContentLoaded", function () {
    const modeBtn = document.getElementById("mode-btn");
    const themes = ["light", "dark"]; // List of available themes
    let currentThemeIndex = localStorage.getItem('themeIndex') || 0; // Default to the first theme

    // Set the initial theme
    setTheme(themes[currentThemeIndex]);

    modeBtn.addEventListener("click", () => {
        // Cycle to the next theme
        currentThemeIndex = (currentThemeIndex + 1) % themes.length;
        const newTheme = themes[currentThemeIndex];
        
        // Apply the new theme
        setTheme(newTheme);
        
        // Save the current theme index to localStorage
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

    // Existing event listeners for navigation
    const navigationButtons = [
        { id: "hub-btn", url: "Hub.html" },
        { id: "home-btn", url: "index.html" },
        { id: "faq-btn", url: "FAQ.html" },
        { id: "question-btn", url: "question.html" },
        { id: "contact-btn", url: "contacte.html" },
        { id: "connexion-btn", url: "Page_De_Connexion.php" },
        { id: "inscription-btn", url: "Page_Inscription.html" },
        { id: "forgot-password", url: "Mot_de_Passe_oublié.html" }
    ];

    navigationButtons.forEach(({ id, url }) => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener("click", () => window.location.href = url);
        }
    });
});
