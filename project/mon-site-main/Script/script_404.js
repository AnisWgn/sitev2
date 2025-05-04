const konamiCode = ['ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight', 'b', 'a'];
let konamiIndex = 0;
let isSpinning = false;
let audio = null;

document.addEventListener('keydown', (e) => {
    const key = e.key;
    
    if (key === konamiCode[konamiIndex]) {
        konamiIndex++;
        
        if (konamiIndex === konamiCode.length) {
            konamiIndex = 0;
            activateKonamiCode();
        }
    } else {
        konamiIndex = 0;
    }
});

const Code = ['ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight', 'b', 'b'];
let Index = 0;

document.addEventListener('keydown', (e) => {
    const key = e.key;
    
    if (key === Code[Index]) {
        Index++;
        
        if (Index === Code.length) {
            Index = 0;
            window.location.href="game.html";
        }
    } else {
        Index = 0;
    }
});

function activateKonamiCode() {
    if (isSpinning) return;
    isSpinning = true;

    // Create and play audio
    audio = new Audio('Music/Gas_Gas_Gas.mp3')
    audio.loop = true;
    audio.volume = 1;
    audio.play();

    // Add spinning animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .konami-spin {
            animation: spin 0.000008s linear infinite;
        }
    `;
    document.head.appendChild(style);
    
    // Change the page appearance
    document.body.style.transition = 'all 1s';
    document.body.style.backgroundColor = '#000';
    document.body.style.color = '#0f0';
    document.body.classList.add('konami-spin');
    
    // Add a retro gaming message
    const message = document.createElement('div');
    message.textContent = 'INFINITE SPIN MODE ACTIVATED! ';
    message.style.position = 'fixed';
    message.style.top = '50%';
    message.style.left = '50%';
    message.style.transform = 'translate(-50%, -50%)';
    message.style.fontSize = '2em';
    message.style.fontFamily = 'monospace';
    message.style.zIndex = '9999';
    document.body.appendChild(message);
    
    // Add stop button
    const stopButton = ['x'];
    let stopIndex = 0;
    
    document.addEventListener('keydown', (e) => {
        const key = e.key;
        
        if (key === stopButton[stopIndex]) {
            stopIndex++;
            
            if (stopIndex === stopButton.length) {
                stopIndex = 0;
                document.body.style.backgroundColor = '';
                document.body.style.color = '';
                document.body.classList.remove('konami-spin');
                message.remove();
                isSpinning = false;
                
                // Stop the music
                if (audio) {
                    audio.pause();
                    audio.currentTime = 0;
                    audio = null;
                }
            }
        } else {
            stopIndex = 0;
        }
    });
}
