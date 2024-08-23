<?php

// Charger les variables d'environnement
$envFilePath = __DIR__ . '/.env';

if (file_exists($envFilePath)) {
    $envFileContent = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envFileContent as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        if (!putenv(sprintf('%s=%s', $key, $value))) {
            exit('Erreur lors de la définition de la variable d\'environnement.');
        }
    }
} else {
    exit('Erreur : fichier .env non trouvé.');
}

// Récupérer les variables d'environnement
$dbHost = getenv('DB_HOST');
$dbPort = getenv('DB_PORT');
$dbName = getenv('DB_DATABASE');
$dbUser = getenv('DB_USERNAME');
$dbPassword = getenv('DB_PASSWORD');

// Connexion à la base de données
$dsn = sprintf(
    'pgsql:host=%s;port=%d;dbname=%s;',
    $dbHost,
    $dbPort,
    $dbName
);

try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données PostgreSQL!<br>";
} catch (PDOException $e) {
    exit('Échec de la connexion : ' . $e->getMessage());
}

// Chemin de base pour les chemins relatifs
$baseDir = __DIR__ . '';

// Liste des chemins d'accès aux images
$imagePaths = [
    $baseDir . '/public/images/habitats/jungle.jpg',
    $baseDir . '/public/images/habitats/jungle2.jpg',
    $baseDir . '/public/images/habitats/jungle3.jpg',
    $baseDir . '/public/images/habitats/jungle4.jpg',
    $baseDir . '/public/images/habitats/jungle5.jpg',
    $baseDir . '/public/images/habitats/jungle6.jpg',
    $baseDir . '/public/images/habitats/jungle7.jpg',
    $baseDir . '/public/images/habitats/marais.jpg',
    $baseDir . '/public/images/habitats/marais2.jpg',
    $baseDir . '/public/images/habitats/marais3.jpg',
    $baseDir . '/public/images/habitats/marais4.jpg',
    $baseDir . '/public/images/habitats/marais5.jpg',
    $baseDir . '/public/images/habitats/marais6.jpg',
    $baseDir . '/public/images/habitats/savane.jpg',
    $baseDir . '/public/images/habitats/savane2.jpg',
    $baseDir . '/public/images/habitats/savane3.jpg',
    $baseDir . '/public/images/habitats/savane4.jpg',
    $baseDir . '/public/images/habitats/savane5.jpg',
    $baseDir . '/public/images/habitats/savane6.jpg',
    $baseDir . '/public/images/habitats/savane7.jpg',
    $baseDir . '/public/images/habitats/savane8.jpg',
    $baseDir . '/public/images/habitats/savane9.jpg',
    $baseDir . '/public/images/habitats/savane10.jpg',
    $baseDir . '/public/images/habitats/savane11.jpg',
    $baseDir . '/public/images/habitats/savane12.jpg',
    $baseDir . '/public/images/divers/panneaux.jpg',
    $baseDir . '/public/images/divers/restaurant.jpg',
    $baseDir . '/public/images/divers/snack.jpg',
    $baseDir . '/public/images/divers/sucre.jpg',
    $baseDir . '/public/images/divers/train1.jpg',
    $baseDir . '/public/images/divers/train2.jpg',
    $baseDir . '/public/images/divers/train3.jpg',
    $baseDir . '/public/images/divers/train4.jpg',
    $baseDir . '/public/images/divers/visite1.jpg',
    $baseDir . '/public/images/divers/visite2.jpg',
    $baseDir . '/public/images/divers/visite3.jpg',
    $baseDir . '/public/images/divers/visite4.jpg',
    $baseDir . '/public/images/divers/visite5.jpg',
    $baseDir . '/public/images/divers/visite6.jpg',
    $baseDir . '/public/images/icones/empreinte.svg',
    $baseDir . '/public/images/icones/Facebook.svg',
    $baseDir . '/public/images/icones/horloge.svg',
    $baseDir . '/public/images/icones/Instagram.svg',
    $baseDir . '/public/images/icones/Linkedin.svg',
    $baseDir . '/public/images/icones/restaurant.svg',
    $baseDir . '/public/images/icones/train.svg',
    $baseDir . '/public/images/icones/visite.svg',
    $baseDir . '/public/images/logo/Arcadia.svg',
    $baseDir . '/public/images/animaux/ara.jpg',
    $baseDir . '/public/images/animaux/ara2.jpg',
    $baseDir . '/public/images/animaux/crocodile.jpg',
    $baseDir . '/public/images/animaux/elephant.jpg',
    $baseDir . '/public/images/animaux/flamant.jpg',
    $baseDir . '/public/images/animaux/girafe.jpg',
    $baseDir . '/public/images/animaux/gorille.jpg',
    $baseDir . '/public/images/animaux/guepard.jpg',
    $baseDir . '/public/images/animaux/hippopotame.jpg',
    $baseDir . '/public/images/animaux/lion.jpg',
    $baseDir . '/public/images/animaux/lion2.jpg',
    $baseDir . '/public/images/animaux/lion3.jpg',
    $baseDir . '/public/images/animaux/ours.jpg',
    $baseDir . '/public/images/animaux/panda_roux.jpg',
    $baseDir . '/public/images/animaux/panthere.jpg',
    $baseDir . '/public/images/animaux/python.jpg',
    $baseDir . '/public/images/animaux/salamandre.jpg',
    $baseDir . '/public/images/animaux/salamandre2.jpg',
    $baseDir . '/public/images/animaux/singe.jpg',
    $baseDir . '/public/images/animaux/tigre.jpg',
    $baseDir . '/public/images/animaux/tortue.jpg',
    $baseDir . '/public/images/animaux/zebre.jpg',
    $baseDir . '/public/images/animaux/zebres.jpg',
];

try {
    $pdo->beginTransaction();
    
    $stmt = $pdo->prepare("INSERT INTO image (image_path, image_name) VALUES (:image_path, :image_name)");

    foreach ($imagePaths as $path) {
        if (file_exists($path)) {
            // Extraire le chemin relatif
            $relativePath = str_replace($baseDir . '/', '', $path);

            // Extraire le nom de fichier
            $imageName = basename($path);
            
            // Bind des valeurs
            $stmt->bindParam(':image_path', $relativePath);
            $stmt->bindParam(':image_name', $imageName);
            $stmt->execute();
            
            echo "Image insérée avec succès depuis le chemin relatif : $relativePath avec le nom : $imageName<br>";
        } else {
            echo "Erreur : le fichier n'existe pas à l'emplacement : $path<br>";
        }
    }
    
    $pdo->commit();
    echo "Toutes les images ont été insérées avec succès.";
} catch (Exception $e) {
    $pdo->rollBack();
    exit("Échec de l'insertion des images : " . $e->getMessage());
}

?>
