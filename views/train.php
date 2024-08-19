<?php 
$title = "Visite du Zoo en Petit Train"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/train.css"> <!-- Fichier CSS spécifique pour la page du petit train -->

<div class="main-container">

    <!-- Section Titre et Introduction -->
    <section id="train-title">
        <h1>Visite du Zoo en Petit Train</h1>
        <p>Embarquez pour une aventure unique à travers le Zoo d'Arcadia grâce à notre petit train panoramique. Profitez d'une expérience confortable et enrichissante en découvrant nos habitats et nos pensionnaires sous un nouvel angle.</p>
    </section>

    <!-- Section Galerie Photos -->
    <section id="train-gallery">
        <h2>Galerie Photos</h2>
        <div class="gallery">
            <img src="/arcadia/public/images/divers/train1.jpg" alt="Petit train avec visiteurs">
            <img src="/arcadia/public/images/divers/train2.jpg" alt="Vue du train sur les habitats">
            <img src="/arcadia/public/images/divers/train3.jpg" alt="Arrêt du train devant l'enclos des lions">
            <img src="/arcadia/public/images/divers/train4.jpg" alt="Vue panoramique depuis le train">
        </div>
    </section>

    <!-- Section Détails du Tour en Train -->
    <section id="train-details">
        <h2>Détails de la Visite en Train</h2>
        <p>Notre petit train vous emmène à travers les principaux habitats du zoo, avec plusieurs points d'arrêt pour vous permettre de descendre et d'explorer plus en détail. Chaque tour dure environ 45 minutes, vous offrant une vue d'ensemble du parc et des informations intéressantes sur nos animaux.</p>
        
        <h3>Points d'Arrêt du Train</h3>
        <ul>
            <li><strong>Arrêt 1 :</strong> La Jungle – Découvrez la végétation dense et les espèces qui y résident, comme les gorilles et les perroquets aras.</li>
            <li><strong>Arrêt 2 :</strong> La Savane – Admirez les majestueux lions et les groupes de zèbres en train de paître dans cet environnement vaste et ouvert.</li>
            <li><strong>Arrêt 3 :</strong> Le Marais – Observez les alligators et les salamandres dans leur habitat aquatique naturel.</li>
        </ul>

        <h3>Vues Panoramiques Exclusives</h3>
        <p>Le tour en train offre également des vues panoramiques que vous ne pourrez découvrir qu'à bord. Vous verrez des scènes à couper le souffle, où la faune et la flore se dévoilent sous leur meilleur jour, loin des sentiers pédestres traditionnels.</p>
    </section>

    <!-- Section Horaires et Tarifs -->
    <section id="train-schedule-pricing">
        <h2>Horaires et Tarifs</h2>
        <p><strong>Horaires :</strong> Le petit train circule tous les jours de 10h à 18h.</p>
        <p><strong>Tarif :</strong> 5€ par personne</p>
        <p>Les billets pour le petit train peuvent être achetés à l'entrée du zoo ou directement à bord du train.</p>
    </section>

</div>

<?php 
include 'partials/footer.php'; 
?>
