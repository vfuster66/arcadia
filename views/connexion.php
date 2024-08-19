<?php 
$title = "Connexion"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/connexion.css"> <!-- Style spécifique pour la connexion -->

<div class="main-container">
    <section id="login">
        <h2>Connexion</h2>
        <form action="/arcadia/controllers/login.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
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
