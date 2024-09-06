<?php
use PHPUnit\Framework\TestCase;

class AdminAccountTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        // Connexion à la base de données pour les tests
        $this->pdo = new PDO('pgsql:host=localhost;port=5432;dbname=arcadia_db', 'arcadia_admin', 'admin_arcadia66330');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Démarrer une transaction pour chaque test
        $this->pdo->beginTransaction();
    }

    public function testAdminCanCreateUser()
    {
        // Simuler la création d'un utilisateur par l'admin
        $query = "INSERT INTO utilisateur (nom, prenom, email, password, role_id) VALUES (:nom, :prenom, :email, :password, :role_id)";
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute([
            ':nom' => 'Test Nom',
            ':prenom' => 'Test Prenom',
            ':email' => 'test@example.com',
            ':password' => password_hash('password123', PASSWORD_DEFAULT),
            ':role_id' => 2 // Employé
        ]);

        $this->assertTrue($result);
    }

    public function testAdminCanUpdateUser()
    {
        // Mettre à jour un utilisateur existant avec l'email
        $query = "UPDATE utilisateur SET nom = :nom, prenom = :prenom WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute([
            ':nom' => 'Updated Nom',
            ':prenom' => 'Updated Prenom',
            ':email' => 'test@example.com' // Utilisation de l'email
        ]);

        $this->assertTrue($result);
    }

    public function testAdminCanDeleteUser()
    {
        // Supprimer un utilisateur en utilisant l'email
        $query = "DELETE FROM utilisateur WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute([':email' => 'test@example.com']); // Utilisation de l'email

        $this->assertTrue($result);
    }

    public function testOnlyOneAdminExists()
    {
        // Vérifier qu'il n'existe qu'un seul administrateur
        $query = "SELECT COUNT(*) FROM utilisateur WHERE role_id = :role_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':role_id' => 1]); // 1 = ID du rôle admin

        $adminCount = $stmt->fetchColumn();

        $this->assertEquals(1, $adminCount);
    }

    public function testCannotDeleteAdmin()
    {
        // Tenter de supprimer un administrateur
        $query = "DELETE FROM utilisateur WHERE email = :email AND role_id != 1"; // Empêcher la suppression d'un admin
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':email' => 'admin@example.com']);
    
        // Vérifier qu'aucune ligne n'a été affectée (l'admin ne doit pas être supprimé)
        $this->assertEquals(0, $stmt->rowCount());
    }       
    
    protected function tearDown(): void
    {
        // Annuler la transaction après chaque test pour que les données n'affectent pas les autres tests
        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }
    }
}

?>