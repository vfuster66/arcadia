<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../models/User.php';

class UserModelTest extends TestCase
{
    protected $pdo;
    protected $userModel;

    protected function setUp(): void
    {
        $this->pdo = new PDO('pgsql:host=localhost;port=5432;dbname=arcadia_db', 'arcadia_admin', 'admin_arcadia66330');
        $this->userModel = new User($this->pdo);

        // Nettoyer l'utilisateur de test avant chaque test pour éviter les doublons
        $this->pdo->query("DELETE FROM utilisateur WHERE email = 'test@example.com'");
    }

    public function testCreateUser()
    {
        // Test de création d'un nouvel utilisateur
        $result = $this->userModel->createUser('test@example.com', 'password123', 'employe', 'Nom', 'Prenom');
        $this->assertTrue($result);
    }

    public function testUpdateUser()
    {
        // Créer un utilisateur pour pouvoir le mettre à jour
        $this->userModel->createUser('test@example.com', 'password123', 'employe', 'Nom', 'Prenom');

        // Mise à jour de l'utilisateur
        $result = $this->userModel->updateUser(1, 'test@example.com', 'newpassword', 'employe', 'UpdatedNom', 'UpdatedPrenom');
        $this->assertTrue($result);
    }

    public function testFindUserByEmail()
    {
        // Créer un utilisateur pour pouvoir le chercher
        $this->userModel->createUser('test@example.com', 'password123', 'employe', 'Nom', 'Prenom');

        // Recherche de l'utilisateur par email
        $user = $this->userModel->findUserByEmail('test@example.com');
        $this->assertIsArray($user);
        $this->assertEquals('test@example.com', $user['email']);
    }

    public function testDeleteUser()
    {
        // Créer un utilisateur pour pouvoir le supprimer
        $this->userModel->createUser('test@example.com', 'password123', 'employe', 'Nom', 'Prenom');

        // Suppression de l'utilisateur
        $result = $this->userModel->deleteUser(1);
        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        // Nettoyer les utilisateurs de test après chaque test
        $this->pdo->query("DELETE FROM utilisateur WHERE email = 'test@example.com'");
    }
}

?>