// Animation du scroll smooth
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Animation des éléments au scroll
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
        }
    });
}, observerOptions);

// Observer les sections
document.querySelectorAll('section').forEach(section => {
    observer.observe(section);
});

// Animation de la navigation
let lastScroll = 0;
const header = document.querySelector('header');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll <= 0) {
        header.classList.remove('scroll-up');
        return;
    }
    
    if (currentScroll > lastScroll && !header.classList.contains('scroll-down')) {
        header.classList.remove('scroll-up');
        header.classList.add('scroll-down');
    } else if (currentScroll < lastScroll && header.classList.contains('scroll-down')) {
        header.classList.remove('scroll-down');
        header.classList.add('scroll-up');
    }
    lastScroll = currentScroll;
});

// Gestion de la navigation
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.section');
    const navLinks = document.querySelectorAll('.sidebar-nav a');
    const sidebar = document.querySelector('.sidebar');

    // Fonction pour changer de section
    function changeSection(sectionId) {
        // Masquer toutes les sections
        sections.forEach(section => {
            section.classList.remove('active');
        });

        // Désactiver tous les liens
        navLinks.forEach(link => {
            link.parentElement.classList.remove('active');
        });

        // Afficher la section sélectionnée
        const selectedSection = document.querySelector(sectionId);
        if (selectedSection) {
            selectedSection.classList.add('active');
        }

        // Activer le lien correspondant
        const selectedLink = document.querySelector(`.sidebar-nav a[href="${sectionId}"]`);
        if (selectedLink) {
            selectedLink.parentElement.classList.add('active');
        }

        // Fermer la sidebar sur mobile
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('active');
        }
    }

    // Gestion des clics sur les liens
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const sectionId = this.getAttribute('href');
            changeSection(sectionId);
        });
    });

    // Gestion du scroll
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                const sectionId = '#' + section.getAttribute('id');
                changeSection(sectionId);
            }
        });
    });

    // Gestion du formulaire de contact
    const contactForm = document.querySelector('.contact-form form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('includes/process-contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Statut de la réponse:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Réponse du serveur:', data);
                
                // Supprimer les anciens messages d'alerte
                const oldAlert = document.querySelector('.contact-form .alert');
                if (oldAlert) {
                    oldAlert.remove();
                }
                
                // Créer un nouveau message d'alerte
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert ${data.success ? 'success' : 'error'}`;
                
                // Ajouter l'icône
                const icon = document.createElement('i');
                icon.className = `fas ${data.success ? 'fa-check-circle' : 'fa-exclamation-circle'}`;
                alertDiv.appendChild(icon);
                
                // Ajouter le texte
                const text = document.createElement('span');
                text.textContent = data.message;
                alertDiv.appendChild(text);
                
                // Insérer le message avant le formulaire
                contactForm.parentNode.insertBefore(alertDiv, contactForm);
                
                // Si succès, réinitialiser le formulaire
                if (data.success) {
                    this.reset();
                    
                    // Supprimer le message après 5 secondes
                    setTimeout(() => {
                        alertDiv.style.opacity = '0';
                        setTimeout(() => alertDiv.remove(), 300);
                    }, 5000);
                }
            })
            .catch(error => {
                console.error('Erreur détaillée:', error);
                
                // Supprimer les anciens messages d'alerte
                const oldAlert = document.querySelector('.contact-form .alert');
                if (oldAlert) {
                    oldAlert.remove();
                }
                
                // Créer un message d'erreur
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert error';
                
                const icon = document.createElement('i');
                icon.className = 'fas fa-exclamation-circle';
                alertDiv.appendChild(icon);
                
                const text = document.createElement('span');
                text.textContent = 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.';
                alertDiv.appendChild(text);
                
                contactForm.parentNode.insertBefore(alertDiv, contactForm);
            });
        });
    }

    // Gestion du menu mobile
    const menuButton = document.createElement('button');
    menuButton.className = 'menu-toggle';
    menuButton.innerHTML = '<i class="fas fa-bars"></i>';
    document.body.appendChild(menuButton);

    menuButton.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    // Fermer le menu mobile en cliquant en dehors
    document.addEventListener('click', function(e) {
        if (!sidebar.contains(e.target) && !menuButton.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    });
}); 