
<?php 
$title = "Nos Services"; 
include 'partials/header.php'; 

require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données

// Récupérer les services depuis la base de données
$query = "SELECT 
            s.service_id,
            s.nom, 
            s.description, 
            s.type, 
            s.horaires, 
            s.prix, 
            i.image_path
          FROM service s
          LEFT JOIN image i ON s.image_id = i.image_id";
$stmt = $pdo->query($query);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <?php foreach ($services as $service): ?>
            <div class="service">
                <div class="service-image">
                    <img src="<?= htmlspecialchars('/arcadia/' . ltrim($service['image_path'], '/')) ?>" alt="<?= htmlspecialchars($service['nom']) ?>">
                </div>
                <div class="service-info">
                    <h2><?= htmlspecialchars($service['nom']) ?></h2>
                    <p><?= htmlspecialchars($service['description']) ?></p>
                    <p><strong>Horaires : </strong><?= htmlspecialchars($service['horaires']) ?></p>
                    <p><strong>Tarif :</strong> <?= htmlspecialchars(number_format($service['prix'], 2)) ?>€</p>
                    <a href="service-detail.php?id=<?= $service['service_id'] ?>">En savoir plus...</a> <!-- Assurez-vous que l'ID est correct -->

                </div>
            </div>
        <?php endforeach; ?>
    </section>

</div>

<?php 
include 'partials/footer.php'; 
?>
