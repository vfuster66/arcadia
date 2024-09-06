<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données

// Récupère l'ID du service, par défaut à 1, et vérifie qu'il s'agit bien d'un entier
$serviceId = isset($_GET['id']) && ctype_digit($_GET['id']) ? (int)$_GET['id'] : 1;

$query = "SELECT s.nom, sd.section_title, sd.section_content, sd.image_path, s.type
          FROM service_details sd
          JOIN service s ON s.service_id = sd.service_id
          WHERE sd.service_id = :service_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['service_id' => $serviceId]);
$serviceSections = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$serviceSections) {
    // Si aucun service trouvé, affiche une page 404 ou un message d'erreur
    http_response_code(404);
    echo "Service non trouvé.";
    exit;
}

$type = $serviceSections[0]['type'] ?? 'default';
$title = $serviceSections[0]['nom'] ?? 'Service Inconnu';

// Route vers le bon template en fonction du type de service
switch ($type) {
    case 'train':
        include 'service-train.php';
        break;
    case 'visite':
        include 'service-visite.php';
        break;
    case 'restaurant':
        include 'service-restauration.php';
        break;
    default:
        include 'service-default.php';
        break;
}
?>
