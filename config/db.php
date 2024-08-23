<?php

// Charger les variables d'environnement manuellement
$envFilePath = __DIR__ . '/../.env';

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

// Vérifier que toutes les variables d'environnement nécessaires sont définies
if (!$dbHost || !$dbPort || !$dbName || !$dbUser || !$dbPassword) {
    exit('Erreur : une ou plusieurs variables d\'environnement ne sont pas définies.');
}

$dsn = sprintf(
    'pgsql:host=%s;port=%d;dbname=%s;',
    $dbHost,
    $dbPort,
    $dbName
);

try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('Échec de la connexion : ' . $e->getMessage());
}

