<?php

use PHPUnit\Framework\TestCase;
use PDO;

class DatabaseTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Début du setup
        error_log("Début du setup pour les tests de la base de données.");

        // Chemin du fichier .env
        $envFilePath = __DIR__ . '/../.env';
        error_log("Chemin calculé pour .env : " . $envFilePath);

        // Charger les variables d'environnement manuellement
        if (file_exists($envFilePath)) {
            error_log(".env trouvé.");
            $envFileContent = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($envFileContent as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }

                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);

                if (!putenv(sprintf('%s=%s', $key, $value))) {
                    error_log("Erreur lors de la définition de la variable d'environnement $key.");
                }
            }
        } else {
            error_log("Erreur : .env non trouvé à l'emplacement attendu.");
        }

        // Définir les valeurs par défaut si les variables d'environnement ne sont pas définies
        $dbHost = getenv('DB_HOST') ?: 'localhost';
        $dbPort = getenv('DB_PORT') ?: 5432;
        $dbName = getenv('DB_DATABASE') ?: 'arcadia_test_db';
        $dbUser = getenv('DB_USERNAME') ?: 'arcadia_admin';
        $dbPassword = getenv('DB_PASSWORD') ?: 'admin_arcadia66330';

        // Log les valeurs des variables d'environnement ou des valeurs par défaut utilisées
        if (getenv('DB_HOST')) {
            error_log("Utilisation des variables d'environnement.");
        } else {
            error_log("Utilisation des valeurs par défaut.");
        }

        error_log("DB_HOST: " . $dbHost);
        error_log("DB_PORT: " . $dbPort);
        error_log("DB_DATABASE: " . $dbName);

        $dsn = sprintf(
            'pgsql:host=%s;port=%d;dbname=%s;',
            $dbHost,
            $dbPort,
            $dbName
        );

        try {
            $this->pdo = new PDO($dsn, $dbUser, $dbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("Connexion à la base de données réussie.");
        } catch (PDOException $e) {
            error_log("Échec de la connexion à la base de données : " . $e->getMessage());
            throw $e;
        }
    }

    public function testInsertIntoDatabase()
    {
        error_log("Test d'insertion dans la base de données.");
        $statement = $this->pdo->prepare("INSERT INTO animals (name, species) VALUES (:name, :species)");
        $statement->execute(['name' => 'Lion', 'species' => 'Panthera leo']);

        $this->assertEquals(1, $statement->rowCount());
        error_log("Insertion réussie avec " . $statement->rowCount() . " ligne(s) insérée(s).");

        // Vérifiez immédiatement après l'insertion si l'enregistrement est présent
        $statement = $this->pdo->query("SELECT * FROM animals WHERE name = 'Lion'");
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        error_log("Résultat de la sélection après insertion : " . json_encode($result));
        $this->assertNotEmpty($result);
    }

    public function testSelectFromDatabase()
    {
        error_log("Test de sélection dans la base de données.");
    
        // Ajouter une insertion ici pour assurer que le Lion est présent
        $statement = $this->pdo->prepare("INSERT INTO animals (name, species) VALUES (:name, :species)");
        $statement->execute(['name' => 'Lion', 'species' => 'Panthera leo']);
        error_log("Insertion réussie avec " . $statement->rowCount() . " ligne(s) insérée(s) dans testSelectFromDatabase.");
    
        // Sélectionner l'enregistrement après l'insertion
        $statement = $this->pdo->query("SELECT * FROM animals WHERE name = 'Lion'");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        error_log("Résultat de la sélection : " . json_encode($result));
        $this->assertNotEmpty($result);
        $this->assertEquals('Lion', $result['name']);
        $this->assertEquals('Panthera leo', $result['species']);
    }

    protected function tearDown(): void
    {
        error_log("Nettoyage de la base de données après les tests.");
        $this->pdo->query("DELETE FROM animals WHERE name = 'Lion'");
        $this->pdo = null;
        error_log("Connexion à la base de données fermée.");
    }
}
