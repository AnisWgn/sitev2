<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock Paper Scissors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #818cf8;
            --win-color: #10b981;
            --lose-color: #ef4444;
            --draw-color: #f59e0b;
            --bg-gradient: linear-gradient(135deg, #111827, #1f2937);
            --card-bg: rgba(255, 255, 255, 0.05);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: var(--bg-gradient);
            color: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            padding: 30px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }

        .scoreboard {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
            gap: 20px;
        }

        .score-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 20px;
            text-align: center;
            flex: 1;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: var(--transition);
        }

        .score-card:hover {
            transform: translateY(-5px);
        }

        .score-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .score-value {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .game-status {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 40px;
            font-weight: 600;
            height: 40px;
        }

        .win {
            color: var(--win-color);
        }

        .lose {
            color: var(--lose-color);
        }

        .draw {
            color: var(--draw-color);
        }

        .choice-area {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 50px;
        }

        .battle-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .player-choice, .computer-choice {
            width: 40%;
            text-align: center;
        }

        .vs {
            font-size: 1.8rem;
            font-weight: bold;
            opacity: 0.6;
        }

        .choice-title {
            margin-bottom: 20px;
            font-size: 1.2rem;
            opacity: 0.8;
        }

        .choice-display {
            font-size: 4rem;
            background: var(--card-bg);
            border-radius: 50%;
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
        }

        .choice-btn {
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            cursor: pointer;
            color: white;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .choice-btn:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.1);
        }

        .choice-btn.rock:hover {
            color: #f87171;
        }

        .choice-btn.paper:hover {
            color: #93c5fd;
        }

        .choice-btn.scissors:hover {
            color: #fcd34d;
        }

        .choice-btn:active {
            transform: scale(0.95);
        }

        .reset-btn {
            display: block;
            margin: 0 auto;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.4);
        }

        .reset-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.6);
        }

        .reset-btn:active {
            transform: translateY(1px);
        }

        .choice-icon {
            transition: transform 0.5s ease;
        }

        .choice-display.animated .choice-icon {
            animation: pulse 0.5s ease;
        }

        .player-wins .choice-display, .player-wins .choice-title {
            color: var(--win-color);
        }

        .computer-wins .choice-display, .computer-wins .choice-title {
            color: var(--win-color);
        }

        @keyframes pulse {
            0% { transform: scale(0.8); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @media (max-width: 600px) {
            .battle-area {
                flex-direction: column;
                gap: 30px;
            }

            .player-choice, .computer-choice {
                width: 100%;
            }

            .choice-area {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Rock Paper Scissors</h1>
        </header>

        <div class="scoreboard">
            <div class="score-card">
                <div class="score-title">Player</div>
                <div class="score-value" id="player-score">0</div>
            </div>
            <div class="score-card">
                <div class="score-title">Draws</div>
                <div class="score-value" id="draw-score">0</div>
            </div>
            <div class="score-card">
                <div class="score-title">Computer</div>
                <div class="score-value" id="computer-score">0</div>
            </div>
        </div>

        <div class="game-status" id="game-status">Choose your weapon!</div>

        <div class="battle-area">
            <div class="player-choice">
                <div class="choice-title">Your Choice</div>
                <div class="choice-display" id="player-display">
                    <i class="choice-icon fas fa-question"></i>
                </div>
            </div>
            <div class="vs">VS</div>
            <div class="computer-choice">
                <div class="choice-title">Computer's Choice</div>
                <div class="choice-display" id="computer-display">
                    <i class="choice-icon fas fa-question"></i>
                </div>
            </div>
        </div>

        <div class="choice-area">
            <button class="choice-btn rock" data-choice="rock">
                <i class="fas fa-hand-rock"></i>
            </button>
            <button class="choice-btn paper" data-choice="paper">
                <i class="fas fa-hand-paper"></i>
            </button>
            <button class="choice-btn scissors" data-choice="scissors">
                <i class="fas fa-hand-scissors"></i>
            </button>
        </div>

        <button class="reset-btn" id="reset-btn">Reset Game</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Game state
            let scores = {
                player: 0,
                computer: 0,
                draw: 0
            };

            // DOM elements
            const playerScore = document.getElementById('player-score');
            const computerScore = document.getElementById('computer-score');
            const drawScore = document.getElementById('draw-score');
            const gameStatus = document.getElementById('game-status');
            const playerDisplay = document.getElementById('player-display');
            const computerDisplay = document.getElementById('computer-display');
            const choiceButtons = document.querySelectorAll('.choice-btn');
            const resetBtn = document.getElementById('reset-btn');

            // Choice icons
            const choiceIcons = {
                rock: '<i class="choice-icon fas fa-hand-rock"></i>',
                paper: '<i class="choice-icon fas fa-hand-paper"></i>',
                scissors: '<i class="choice-icon fas fa-hand-scissors"></i>',
                question: '<i class="choice-icon fas fa-question"></i>'
            };

            // Event listeners
            choiceButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const playerChoice = button.dataset.choice;
                    playRound(playerChoice);
                });
            });

            resetBtn.addEventListener('click', resetGame);

            // Play a round
            function playRound(playerChoice) {
                // Get computer choice
                const choices = ['rock', 'paper', 'scissors'];
                const computerChoice = choices[Math.floor(Math.random() * 3)];
                
                // Update displays
                updateChoiceDisplay(playerDisplay, playerChoice);
                
                // Simulate computer "thinking"
                gameStatus.textContent = "Computer is choosing...";
                gameStatus.className = '';
                
                // Reset style classes
                playerDisplay.classList.remove('player-wins');
                computerDisplay.classList.remove('computer-wins');
                
                // Delay computer's choice to create suspense
                setTimeout(() => {
                    updateChoiceDisplay(computerDisplay, computerChoice);
                    
                    // Determine winner
                    const result = getWinner(playerChoice, computerChoice);
                    updateScore(result);
                    updateStatus(result, playerChoice, computerChoice);
                    
                    // Add winning visual
                    if (result === 'player') {
                        playerDisplay.classList.add('player-wins');
                    } else if (result === 'computer') {
                        computerDisplay.classList.add('computer-wins');
                    }
                }, 1000);
            }

            // Update choice display
            function updateChoiceDisplay(display, choice) {
                display.innerHTML = choiceIcons[choice];
                display.classList.add('animated');
                
                // Remove animation class after animation completes
                setTimeout(() => {
                    display.classList.remove('animated');
                }, 500);
            }

            // Determine the winner
            function getWinner(playerChoice, computerChoice) {
                if (playerChoice === computerChoice) {
                    return 'draw';
                }
                
                if (
                    (playerChoice === 'rock' && computerChoice === 'scissors') ||
                    (playerChoice === 'paper' && computerChoice === 'rock') ||
                    (playerChoice === 'scissors' && computerChoice === 'paper')
                ) {
                    return 'player';
                }
                
                return 'computer';
            }

            // Update score
            function updateScore(result) {
                scores[result]++;
                playerScore.textContent = scores.player;
                computerScore.textContent = scores.computer;
                drawScore.textContent = scores.draw;
            }

            // Update game status
            function updateStatus(result, playerChoice, computerChoice) {
                const capitalize = (str) => str.charAt(0).toUpperCase() + str.slice(1);
                
                if (result === 'draw') {
                    gameStatus.textContent = `Draw! Both chose ${capitalize(playerChoice)}`;
                    gameStatus.className = 'draw';
                } else if (result === 'player') {
                    gameStatus.textContent = `You win! ${capitalize(playerChoice)} beats ${capitalize(computerChoice)}`;
                    gameStatus.className = 'win';
                } else {
                    gameStatus.textContent = `You lose! ${capitalize(computerChoice)} beats ${capitalize(playerChoice)}`;
                    gameStatus.className = 'lose';
                }
            }

            // Reset game
            function resetGame() {
                scores = {
                    player: 0,
                    computer: 0,
                    draw: 0
                };
                
                playerScore.textContent = '0';
                computerScore.textContent = '0';
                drawScore.textContent = '0';
                
                gameStatus.textContent = 'Choose your weapon!';
                gameStatus.className = '';
                
                playerDisplay.innerHTML = choiceIcons.question;
                computerDisplay.innerHTML = choiceIcons.question;
                
                playerDisplay.classList.remove('player-wins');
                computerDisplay.classList.remove('computer-wins');
            }
        });
    </script>
</body>
</html>