<?php

use PHPUnit\Framework\TestCase;
use PDO;
use Dotenv\Dotenv;

class DatabaseTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Charger les variables d'environnement depuis le fichier .env.testing
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..'); // Adapter le chemin selon la structure de votre projet
        $dotenv->load();

        $dsn = sprintf(
            'pgsql:host=%s;port=%d;dbname=%s;',
            getenv('DB_HOST'),
            getenv('DB_PORT'),
            getenv('DB_DATABASE')
        );

        $this->pdo = new PDO($dsn, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testConnection()
    {
        $this->assertNotNull($this->pdo);
    }

    public function testInsertIntoDatabase()
    {
        $statement = $this->pdo->prepare("INSERT INTO animals (name, species) VALUES (:name, :species)");
        $statement->execute(['name' => 'Lion', 'species' => 'Panthera leo']);

        $this->assertEquals(1, $statement->rowCount());
    }

    public function testSelectFromDatabase()
    {
        $statement = $this->pdo->query("SELECT * FROM animals WHERE name = 'Lion'");
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result);
        $this->assertEquals('Lion', $result['name']);
        $this->assertEquals('Panthera leo', $result['species']);
    }

    protected function tearDown(): void
    {
        $this->pdo->query("DELETE FROM animals WHERE name = 'Lion'");
        $this->pdo = null;
    }
}
