<?php 
$title = "Nos Services"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/services.css"> <!-- Fichier CSS spécifique pour la page des services -->

<div class="main-container">

    <!-- Section Titre des Services -->
    <section id="services-title">
        <h1>Découvrez Nos Services</h1>
        <p>Explorez en détail les services que nous offrons pour rendre votre visite au Zoo d'Arcadia inoubliable.</p>
    </section>

    <!-- Section Détail des Services -->
    <section id="services-detail">
        <div class="service">
            <div class="service-image">
                <img src="/arcadia/public/images/icones/train.svg" alt="Train">
            </div>
            <div class="service-info">
                <h2>Visite Panoramique en Train</h2>
                <p>Montez à bord de notre petit train pour une visite panoramique du zoo. Vous découvrirez les différents habitats et leurs habitants de manière ludique et relaxante. Parfait pour une vue d'ensemble avant d'explorer plus en profondeur.</p>
                <p><strong>Horaires : </strong>De 10h à 18h, tous les jours.</p>
                <p><strong>Tarif :</strong> 5€ par personne</p>
                <a href="train.php" class="learn-more-link">En savoir plus...</a>
            </div>
        </div>

        <div class="service">
            <div class="service-image">
                <img src="/arcadia/public/images/icones/visite.svg" alt="Visite Guidée">
            </div>
            <div class="service-info">
                <h2>Visite Guidée Immersive</h2>
                <p>Profitez d'une visite guidée immersive à travers nos habitats. Nos guides passionnés vous emmèneront dans un voyage éducatif et captivant, vous expliquant les efforts de conservation du zoo et les caractéristiques uniques de chaque espèce.</p>
                <p><strong>Durée : </strong>1h30</p>
                <p><strong>Horaires: </strong>11h00 - 13h00 - 15h00 - 17h00</p>
                <p><strong>Tarif :</strong> Gratuit</p>
                <p><strong>Réservation : </strong>Recommandée</p>
                <a href="visite.php" class="learn-more-link">En savoir plus...</a>
            </div>
        </div>

        <div class="service">
            <div class="service-image">
                <img src="/arcadia/public/images/icones/restaurant.svg" alt="Restaurant">
            </div>
            <div class="service-info">
                <h2>Restauration et Snacks</h2>
                <p>Nos restaurants et snacks vous proposent une large gamme de plats, des repas rapides aux menus complets. Tous nos mets sont préparés avec des ingrédients frais et locaux pour ravir vos papilles pendant votre visite.</p>
                <p><strong>Options :</strong> Végétariennes, Végétaliennes, Sans Gluten</p>
                <p><strong>Horaires : </strong>De 11h à 20h</p>
                <a href="restauration.php" class="learn-more-link">En savoir plus...</a>
            </div>
        </div>

    </section>

</div>

<?php 
include 'partials/footer.php'; 
?>
