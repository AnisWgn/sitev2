<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de Hash de Mot de Passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="password"], input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9f7ef;
            border-radius: 4px;
            word-break: break-all;
        }
        .copy-btn {
            background-color: #2196F3;
            margin-left: 10px;
        }
        .copy-btn:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Générateur de Hash de Mot de Passe</h1>
        
        <form method="post">
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Générer le hash</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
            
            echo '<div class="result">';
            echo '<h3>Résultat :</h3>';
            echo '<p>Mot de passe original : ' . htmlspecialchars($password) . '</p>';
            echo '<p>Hash généré : <span id="hash">' . $hashedPassword . '</span>';
            echo '<button class="copy-btn" onclick="copyToClipboard()">Copier</button></p>';
            echo '</div>';
        }
        ?>
    </div>

    <script>
        function copyToClipboard() {
            const hash = document.getElementById('hash').textContent;
            navigator.clipboard.writeText(hash).then(() => {
                alert('Hash copié dans le presse-papier !');
            });
        }
    </script>
</body>
</html> 