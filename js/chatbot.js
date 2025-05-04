class Chatbot {
    constructor() {
        this.isOpen = false;
        this.messages = [];
        this.isTyping = false;
        this.initialize();
    }

    initialize() {
        // Créer l'interface du chatbot
        this.createInterface();
        // Ajouter les écouteurs d'événements
        this.addEventListeners();
    }

    createInterface() {
        // Créer le conteneur principal
        const container = document.createElement('div');
        container.className = 'chatbot-container';
        container.innerHTML = `
            <div class="chatbot-header">
                <h3>Assistant IA</h3>
                <button class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="chatbot-messages"></div>
            <div class="chatbot-input">
                <input type="text" placeholder="Tapez votre message...">
                <button class="send-btn"><i class="fas fa-paper-plane"></i></button>
            </div>
        `;
        document.body.appendChild(container);

        // Créer le bouton de lancement
        const launchButton = document.createElement('button');
        launchButton.className = 'chatbot-launch-btn';
        launchButton.innerHTML = '<i class="fas fa-robot"></i>';
        document.body.appendChild(launchButton);
    }

    addEventListeners() {
        const launchBtn = document.querySelector('.chatbot-launch-btn');
        const closeBtn = document.querySelector('.close-btn');
        const sendBtn = document.querySelector('.send-btn');
        const input = document.querySelector('.chatbot-input input');

        launchBtn.addEventListener('click', () => this.toggleChat());
        closeBtn.addEventListener('click', () => this.toggleChat());
        sendBtn.addEventListener('click', () => this.sendMessage());
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.sendMessage();
        });
    }

    toggleChat() {
        const container = document.querySelector('.chatbot-container');
        this.isOpen = !this.isOpen;
        container.style.display = this.isOpen ? 'block' : 'none';
    }

    async sendMessage() {
        const input = document.querySelector('.chatbot-input input');
        const message = input.value.trim();
        
        if (message && !this.isTyping) {
            this.addMessage(message, 'user');
            input.value = '';
            this.isTyping = true;
            
            try {
                const response = await this.getAIResponse(message);
                this.addMessage(response, 'bot');
            } catch (error) {
                this.addMessage("Désolé, je rencontre des difficultés techniques. Veuillez réessayer plus tard.", 'bot');
                console.error('Erreur:', error);
            }
            
            this.isTyping = false;
        }
    }

    async getAIResponse(message) {
        const response = await fetch('includes/chatbot_api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ message })
        });

        if (!response.ok) {
            throw new Error('Erreur de communication avec le serveur');
        }

        const data = await response.json();
        
        if (data.error) {
            throw new Error(data.error);
        }

        return data.response;
    }

    addMessage(text, sender) {
        const messagesContainer = document.querySelector('.chatbot-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;
        
        // Ajouter une animation de frappe pour les messages du bot
        if (sender === 'bot' && this.isTyping) {
            messageDiv.innerHTML = `
                <div class="message-content typing">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="message-content">
                    ${text}
                </div>
            `;
        }
        
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}

// Initialiser le chatbot quand le DOM est chargé
document.addEventListener('DOMContentLoaded', () => {
    new Chatbot();
}); 