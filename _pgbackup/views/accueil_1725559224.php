

<?php
session_start();
?>


<?php 
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../controllers/HorairesController.php'; 

$horairesController = new HorairesController($pdo);
?>

<?php 
$title = "Accueil"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/accueil.css"> <!-- Style spécifique pour l'accueil -->

<div class="main-container">

    <!-- Section Hero -->
    <section id="hero">
        <div class="hero-content">
            <h1>Bienvenue au Zoo Arcadia</h1>
            <a href="services.php" class="btn-hero">Découvrez nos services</a>
        </div>
    </section>

    <!-- Section Présentation -->
    <section id="presentation">
        <div class="presentation-content">
            <p>Le Zoo d'Arcadia, fondé il y a plus de cinquante ans, est un lieu unique en Bretagne, dédié à la préservation de la biodiversité et à l'éducation environnementale.</p>
            <p>Situé près de la forêt de Brocéliande, notre zoo abrite une grande diversité d'animaux provenant des habitats les plus riches du monde, comme la savane, la jungle, et les marais. Chacun de nos pensionnaires est suivi de près par notre équipe de vétérinaires pour garantir leur bien-être quotidien.</p>
            <p>Le Zoo d'Arcadia est fier de son engagement écologique. En tant que parc entièrement autonome en énergie, nous veillons à ce que chaque visite soit non seulement une découverte des merveilles de la nature, mais aussi une immersion dans les valeurs de durabilité et de respect de l'environnement.</p>
        </div>
        <div class="presentation-images">
            <img src="/arcadia/public/images/animaux/gorille.jpg" alt="Gorille">
            <img src="/arcadia/public/images/animaux/zebres.jpg" alt="Zèbres dans leur habitat">
            <img src="/arcadia/public/images/divers/panneaux.jpg" alt="Panneaux photovoltaiques">
        </div>
    </section>

    <!-- Section Nos Habitats -->
    <section id="habitats">
        <h2>Nos Habitats</h2>
        <div class="habitat-cards">
            <div class="habitat-card jungle">
                <div class="habitat-image"></div>
                <h3>La jungle</h3>
            </div>
            <div class="habitat-card savane">
                <div class="habitat-image"></div>
                <h3>La savane</h3>
            </div>
            <div class="habitat-card marais">
                <div class="habitat-image"></div>
                <h3>Le marais</h3>
            </div>
        </div>
        <a href="habitats.php" class="learn-more-link">En savoir plus...</a>
    </section>

    <!-- Section Nos Services -->
    <section id="services">
        <h2>Nos Services</h2>
        <div class="service-grid">
            <div class="service-card">
                <img src="/arcadia/public/images/icones/train.svg" alt="Train">
                <p>Montez à bord de notre petit train pour une visite panoramique du zoo. Une façon ludique et relaxante de parcourir notre parc.</p>
            </div>
            <div class="service-card2">
                <img src="/arcadia/public/images/icones/visite.svg" alt="Visite Guidée">
                <p>Profitez d'une visite guidée immersive à travers nos habitats. Une expérience éducative et captivante pour petits et grands.</p>
            </div>
            <div class="service-card">
                <img src="/arcadia/public/images/icones/restaurant.svg" alt="Restaurant">
                <p>Dégustez des plats variés dans nos restaurants et snacks. Du repas rapide aux menus complets, il y en a pour tous les goûts.</p>
            </div>
        </div>
        <a href="services.php" class="learn-more-link">En savoir plus...</a>
    </section>

    <!-- Section Nos Animaux -->
    <section id="animaux">
        <h2>Nos Animaux</h2>
        <div class="animal-grid">
            <div class="animal-card">
                <div class="animal-image" style="background-image: url('/arcadia/public/images/animaux/ara.jpg');"></div>
                <div class="animal-info">
                    <h3>Perroquet Ara</h3>
                    <p> Cet oiseau coloré, symbole des forêts tropicales, est connu pour son plumage vibrant et son intelligence.</p>
                </div>
            </div>
            <div class="animal-card">
                <div class="animal-image" style="background-image: url('/arcadia/public/images/animaux/lion.jpg');"></div>
                <div class="animal-info2">
                    <h3>Lion d'Afrique</h3>
                    <p>Le roi de la savane, ce félin majestueux est célèbre pour sa crinière imposante et son rugissement puissant.</p>
                </div>
            </div>
            <div class="animal-card">
                <div class="animal-image" style="background-image: url('/arcadia/public/images/animaux/salamandre.jpg');"></div>
                <div class="animal-info">
                    <h3>Salamandre</h3>
                    <p>Avec sa peau tachetée et ses couleurs vives, elle captive l'attention de tous nos visiteurs.</p>
                </div>
            </div>
        </div>
        <a href="animaux.php" class="learn-more-link">En savoir plus...</a>
    </section>

    <!-- Section Avis avec Carousel -->
    <section id="avis-carousel">
        <div class="carousel-container">
            <div class="avis-carousel">
                <div class="avis-card green-card">
                    <h3>Thierry</h3>
                    <p>Très beau parc, nous reviendrons avec plaisir.</p>
                    <div class="icon"></div>
                </div>
                <div class="avis-card brown-card">
                    <h3>Marjorie</h3>
                    <p>Un véritable écrin.</p>
                    <div class="icon"></div>
                </div>
                <div class="avis-card green-card">
                    <h3>Louis</h3>
                    <p>Une visite dépaysante.</p>
                    <div class="icon"></div>
                </div>
                <div class="avis-card brown-card">
                    <h3>Emma</h3>
                    <p>Expérience inoubliable pour les enfants.</p>
                    <div class="icon"></div>
                </div>
                <div class="avis-card green-card">
                    <h3>Paul</h3>
                    <p>Des souvenirs plein la tête !</p>
                    <div class="icon"></div>
                </div>
                <div class="avis-card brown-card">
                    <h3>Sophie</h3>
                    <p>J'ai adoré voir tous les animaux dans leur habitat naturel.</p>
                    <div class="icon"></div>
                </div>
            </div>
        </div>
        
        <div class="map">
            <button class="first active"></button>
            <button class="second"></button>
        </div>

        <div class="submit-avis">
            <button id="open-modal-btn">Soumettre un avis</button>
        </div>
        
    </section>

    <section id="horaires">
        <h2>Horaires</h2>
        <?php 
            $horairesController->afficherHoraires(); 
        ?>
    </section>

</div>

<div id="avis-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Soumettre un avis</h2>
        <form id="avis-form">
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="message">Votre avis:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Envoyer</button>
        </form>
    </div>
</div>

<!-- Inclusion du script carousel.js -->
<script src="/arcadia/public/js/carousel.js"></script>

<?php 
include 'partials/footer.php'; 
?>
