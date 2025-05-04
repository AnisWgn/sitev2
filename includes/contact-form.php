<?php
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (!$name || !$email || !$message) {
        $error = 'Veuillez remplir tous les champs.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Veuillez entrer une adresse email valide.';
    } else {
        // Ici, vous pouvez ajouter le code pour envoyer l'email
        // Par exemple, utiliser la fonction mail() de PHP
        $to = 'aniswagner6@gmail.com';
        $subject = 'Nouveau message du portfolio';
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $success = true;
        } else {
            $error = 'Une erreur est survenue lors de l\'envoi du message.';
        }
    }
}
?>

<form method="POST" action="" class="contact-form">
    <?php if ($success): ?>
        <div class="success-message">
            Votre message a été envoyé avec succès!
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" required></textarea>
    </div>

    <button type="submit" class="submit-button">Envoyer</button>
</form> 