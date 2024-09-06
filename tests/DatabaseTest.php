<?php

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $dbHost = getenv('DB_HOST') ?: 'localhost';
        $dbPort = getenv('DB_PORT') ?: 5432;
        $dbName = getenv('DB_DATABASE') ?: 'arcadia_test_db';
        $dbUser = getenv('DB_USERNAME') ?: 'arcadia_admin';
        $dbPassword = getenv('DB_PASSWORD') ?: 'admin_arcadia66330';
    
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s;', $dbHost, $dbPort, $dbName);
        $this->pdo = new PDO($dsn, $dbUser, $dbPassword);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Réinitialisation de la table animal
        $this->pdo->query("TRUNCATE TABLE animal RESTART IDENTITY CASCADE");
    }
    

    public function testInsertIntoDatabase()
{
    error_log("Début du test d'insertion dans la base de données");
    $statement = $this->pdo->prepare("INSERT INTO animal (prenom, species) VALUES (:prenom, :species)");
    $statement->execute(['prenom' => 'Simba', 'species' => 'Panthera leo']);

    error_log("L'insertion a été effectuée avec succès");
    $this->assertEquals(1, $statement->rowCount());

    $statement = $this->pdo->query("SELECT * FROM animal WHERE prenom = 'Simba'");
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    error_log("Résultat de la sélection: " . json_encode($result));
    $this->assertNotEmpty($result);
    $this->assertEquals('Simba', $result['prenom']);
    $this->assertEquals('Panthera leo', $result['species']);
}

    public function testSelectFromDatabase()
    {
        // Insertion pour assurer la présence d'un animal
        $statement = $this->pdo->prepare("INSERT INTO animal (prenom, species) VALUES (:prenom, :species)");
        $statement->execute(['prenom' => 'Simba', 'species' => 'Panthera leo']);

        // Sélection après insertion
        $statement = $this->pdo->query("SELECT * FROM animal WHERE prenom = 'Simba'");
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result);
        $this->assertEquals('Simba', $result['prenom']);
        $this->assertEquals('Panthera leo', $result['species']);
    }

    protected function tearDown(): void
    {
        // Nettoyage des enregistrements dans la table 'animal'
        $this->pdo->query("TRUNCATE TABLE animal RESTART IDENTITY CASCADE");
        $this->pdo = null;
    }
    
}

 ?>