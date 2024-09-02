<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php

if (!isset($_SESSION['email'])): ?>
    <link rel="stylesheet" href="/arcadia/public/css/footer.css"> <!-- Style spécifique au footer -->

    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="#">Mentions Légales</a>
                <a href="#">Politique de confidentialité</a>
                <a href="#">Plan du site</a>
                <a href="#">Conditions d’utilisation</a>
            </div>
            <div class="footer-contact">
                <p>123 Rue du Zoo, 75000 Paris,<br>France<br>
                    +33 1 23 45 67 89<br>
            </div>
            <div class="footer-bottom">
                <div class="footer-button">
                    <a href="contact.php" class="btn">Nous contacter</a>
                </div>
                <div class="footer-social">
                    <a href="#"><img src="/arcadia/public/images/icones/Facebook.svg" alt="Facebook"></a>
                    <a href="#"><img src="/arcadia/public/images/icones/Instagram.svg" alt="Instagram"></a>
                    <a href="#"><img src="/arcadia/public/images/icones/Linkedin.svg" alt="LinkedIn"></a>
                </div>
            </div>
        </div>
    </footer>
<?php endif; ?>

</body>

</html>