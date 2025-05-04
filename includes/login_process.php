<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;

    error_log("Tentative de connexion avec email: " . $email);

    // Vérification des champs
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Veuillez remplir tous les champs";
        header("Location: ../login.php");
        exit;
    }

    try {
        // Recherche de l'utilisateur
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            error_log("Utilisateur trouvé: oui");
            error_log("Mot de passe stocké: " . $user['password']);
            error_log("Mot de passe fourni: " . $password);

            // Vérification du mot de passe
            if (password_verify($password, $user['password'])) {
                error_log("Vérification du mot de passe: succès");
                
                // Mise à jour de la dernière connexion
                $stmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $stmt->execute([$user['id']]);

                // Création de la session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = $user['is_admin'];

                // Si "Se souvenir de moi" est coché
                if ($remember) {
                    $token = bin2hex(random_bytes(32));
                    $expires = date('Y-m-d H:i:s', strtotime('+30 days'));
                    
                    $stmt = $conn->prepare("INSERT INTO remember_tokens (user_id, token, expires_at) VALUES (?, ?, ?)");
                    $stmt->execute([$user['id'], $token, $expires]);
                    
                    setcookie('remember_token', $token, strtotime('+30 days'), '/', '', true, true);
                }

                header("Location: ../index.php");
                exit;
            } else {
                error_log("Vérification du mot de passe: échec");
                $_SESSION['error'] = "Email ou mot de passe incorrect";
            }
        } else {
            error_log("Utilisateur trouvé: non");
            $_SESSION['error'] = "Email ou mot de passe incorrect";
        }
    } catch (PDOException $e) {
        error_log("Erreur PDO: " . $e->getMessage());
        $_SESSION['error'] = "Une erreur est survenue";
    }

    // En cas d'échec, on garde l'email pour le réafficher
    $_SESSION['email'] = $email;
    header("Location: ../login.php");
    exit;
} else {
    header('Location: ../login.php');
    exit();
} 