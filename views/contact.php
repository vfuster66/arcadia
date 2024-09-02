<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Exemple de traitement : affichage des données (remplacez ceci par une logique d'envoi d'email par exemple)
    echo "<div class='form-response'>";
    echo "<h3>Merci, $name !</h3>";
    echo "<p>Nous avons bien reçu votre message et nous vous répondrons sous peu à l'adresse $email.</p>";
    echo "</div>";
}
?>

<?php 
$title = "Contact"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/contact.css"> <!-- Style spécifique pour la page contact -->

<div class="main-container">
    <!-- Section Contact -->
    <section id="contact">
        <h2>Contactez-nous</h2>
        <p>Si vous avez des questions, des commentaires ou souhaitez en savoir plus sur notre zoo, n'hésitez pas à nous contacter en utilisant le formulaire ci-dessous.</p>
        
        <form action="contact.php" method="POST">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="name">Titre</label>
                <input type="text" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
    </section>
</div>

<?php 
include 'partials/footer.php'; 
?>
