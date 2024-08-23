<?php 
$title = "Connexion"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/connexion.css"> <!-- Style spécifique pour la connexion -->

<div class="main-container">
    <section id="login">
        <h2>Connexion</h2>
        <?php if (isset($_SESSION['login_error'])): ?>
            <p style="color:red;"><?php echo htmlspecialchars($_SESSION['login_error']); ?></p>
            <?php unset($_SESSION['login_error']); // Effacer l'erreur après l'affichage ?>
        <?php endif; ?>
        <form action="/arcadia/controllers/login.php" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Se connecter</button>
        </form>
    </section>
</div>

<?php 
include 'partials/footer.php'; 
?>
