<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des identifiants
    if ($username === 'admin@arcadia.fr' && $password === '123') {
        header("Location: ../views/admin_dashboard.php"); // Rediriger vers le tableau de bord admin
        exit();
    } elseif ($username === 'employe@arcadia.fr' && $password === '123') {
        header("Location: ../views/employe_dashboard.php"); // Rediriger vers le tableau de bord employé
        exit();
    } elseif ($username === 'veterinaire@arcadia.fr' && $password === '123') {
        header("Location: ../views/veterinaire_dashboard.php"); // Rediriger vers le tableau de bord vétérinaire
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<?php 
$title = "Connexion"; 
include '../views/partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/connexion.css">

<div class="main-container">
    <section id="login">
        <h2>Connexion</h2>
        <?php if(isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
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
        <p>Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>
    </section>
</div>

<?php 
include '../views/partials/footer.php'; 
?>
