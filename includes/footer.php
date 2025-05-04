<?php
// Fermeture de la connexion à la base de données
if (isset($conn)) {
    $conn = null;
}
?>
<footer class="footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> Portfolio. Tous droits réservés.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 