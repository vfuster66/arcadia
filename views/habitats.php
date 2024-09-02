<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$title = "Nos Habitats"; 
include 'partials/header.php'; 
require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données
require_once __DIR__ . '/../services/createHabitatPage.php';  // Inclure la fonction pour créer les pages d'habitat
require_once __DIR__ . '/../services/createHabitatCSS.php';   // Inclure la fonction pour créer les fichiers CSS
?>

<link rel="stylesheet" href="/arcadia/public/css/habitats.css"> <!-- Fichier CSS spécifique pour la page des habitats -->
<link rel="stylesheet" href="/arcadia/public/css/animaux.css"> <!-- Fichier CSS spécifique pour les animaux -->

<div class="main-container">
    <h1>Découvrez Nos Habitats</h1>

    <div class="habitats-grid">
        <?php
        // Récupérer tous les habitats depuis la base de données
        $query = "SELECT h.*, i.image_path FROM habitat h
                LEFT JOIN image i ON h.image_id = i.image_id";
        $stmt = $pdo->query($query);
        $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Boucle pour afficher chaque habitat
        foreach ($habitats as $habitat) {
            $nom = htmlspecialchars($habitat['nom']);
            $descriptionRapide = htmlspecialchars($habitat['description_rapide']);
            $descriptionDetaillee = htmlspecialchars($habitat['description_detaillee']);
            
            // Ajoute le préfixe manquant au chemin de l'image
            $imagePath = '/arcadia/' . htmlspecialchars($habitat['image_path']);
        
            // Générer le nom du fichier PHP correspondant à l'habitat (e.g., "savane.php")
            $habitatPage = strtolower(str_replace(' ', '_', $nom)) . '.php';
        
            // Vérifier si la page de l'habitat existe déjà, sinon la créer
            if (!file_exists(__DIR__ . '/../views/' . $habitatPage)) {
                // Récupérer les animaux associés à cet habitat
                $queryAnimals = "SELECT a.* FROM animal a
                                JOIN detient d ON a.animal_id = d.animal_id
                                WHERE d.habitat_id = :habitat_id";
                $stmtAnimals = $pdo->prepare($queryAnimals);
                $stmtAnimals->bindParam(':habitat_id', $habitat['habitat_id'], PDO::PARAM_INT);
                $stmtAnimals->execute();
                $animaux = $stmtAnimals->fetchAll(PDO::FETCH_ASSOC);
        
                // Création de la structure des images à partir des données disponibles
                $images = [
                    [
                        'image_path' => $habitat['image_path'],
                        'alt_text' => $nom // Si 'alt_text' n'est pas défini, utilisez le nom de l'habitat
                    ]
                ];
        
                // Créer la page de l'habitat
                createHabitatPage($nom, $descriptionRapide, $descriptionDetaillee, $images, $animaux);
        
                // Créer le fichier CSS pour l'habitat
                createHabitatCSS($nom);
            }
        
            // Générer le HTML final pour chaque carte d'habitat
            echo '<div class="habitat-card">';
            echo '<a href="/arcadia/views/' . $habitatPage . '">';
            echo '<img src="' . $imagePath . '" alt="' . $nom . '">';
            echo '<h2>' . $nom . '</h2>';
            echo '</a>';
            echo '<p>' . $descriptionRapide . '</p>';
            echo '</div>';
        }        
        
        ?>
    </div>
</div>

<?php 
include 'partials/footer.php'; 
?>
