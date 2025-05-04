document.addEventListener('DOMContentLoaded', function() {
    // Navigation mobile
    const mobileMenuBtn = document.querySelector('.mobile-menu');
    const navMenu = document.querySelector('nav ul');
    
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            navMenu.classList.toggle('show');
        });
    }
    
    // Animation au défilement
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.service-card, .project-card, .about-content, .testimonial');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                element.classList.add('visible');
            }
        });
    };
    
    // Initialiser l'animation au chargement de la page
    animateOnScroll();
    
    // Appliquer l'animation au scroll
    window.addEventListener('scroll', animateOnScroll);
    
    // Gestion des témoignages (carrousel simple)
    const testimonials = document.querySelectorAll('.testimonial');
    let currentIndex = 0;
    
    if (testimonials.length > 2) {
        // Afficher uniquement les deux premiers témoignages
        testimonials.forEach((testimonial, index) => {
            if (index >= 2) {
                testimonial.style.display = 'none';
            }
        });
        
        // Fonction pour faire défiler les témoignages
        const rotateTestimonials = function() {
            testimonials.forEach(testimonial => {
                testimonial.style.display = 'none';
            });
            
            testimonials[currentIndex].style.display = 'block';
            currentIndex = (currentIndex + 1) % testimonials.length;
            testimonials[currentIndex].style.display = 'block';
        };
        
        // Faire défiler les témoignages toutes les 5 secondes
        setInterval(rotateTestimonials, 5000);
    }
    
    // Validation du formulaire de contact
    const contactForm = document.querySelector('.contact-form form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const nameInput = contactForm.querySelector('input[name="nom"]');
            const emailInput = contactForm.querySelector('input[name="email"]');
            const messageInput = contactForm.querySelector('textarea[name="message"]');
            
            let isValid = true;
            
            // Validation du nom
            if (nameInput.value.trim().length < 2) {
                isValid = false;
                nameInput.classList.add('error');
            } else {
                nameInput.classList.remove('error');
            }
            
            // Validation de l'email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                isValid = false;
                emailInput.classList.add('error');
            } else {
                emailInput.classList.remove('error');
            }
            
            // Validation du message
            if (messageInput.value.trim().length < 10) {
                isValid = false;
                messageInput.classList.add('error');
            } else {
                messageInput.classList.remove('error');
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Veuillez corriger les erreurs dans le formulaire avant de l\'envoyer.');
            }
        });
    }
    
    // Ajouter des classes d'animation CSS en fonction du scroll
    const addScrollAnimation = function() {
        const sections = document.querySelectorAll('section');
        
        sections.forEach(section => {
            const sectionTop = section.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (sectionTop < windowHeight - 150) {
                section.classList.add('animate');
            }
        });
    };
    
    // Appliquer les animations au défilement
    window.addEventListener('scroll', addScrollAnimation);
    addScrollAnimation();
}); 