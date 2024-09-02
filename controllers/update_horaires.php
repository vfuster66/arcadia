<?php
require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données

// Récupérer les données du formulaire
$heure_ouverture = $_POST['heure_ouverture'];
$heure_fermeture = $_POST['heure_fermeture'];

foreach ($heure_ouverture as $horaire_id => $heure) {
    $query = "UPDATE horaires SET heure_ouverture = :heure_ouverture, heure_fermeture = :heure_fermeture WHERE horaire_id = :horaire_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':heure_ouverture', $heure);
    $stmt->bindParam(':heure_fermeture', $heure_fermeture[$horaire_id]);
    $stmt->bindParam(':horaire_id', $horaire_id, PDO::PARAM_INT);
    $stmt->execute();
}

// Redirection après mise à jour
header('Location: /arcadia/views/admin_gestion_horaires.php');
exit();
?>
