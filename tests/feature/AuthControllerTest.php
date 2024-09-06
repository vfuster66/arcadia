<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../controllers/AuthController.php';

class AuthControllerTest extends TestCase
{
    protected $userModel;
    protected $authController;

    protected function setUp(): void
    {
        // Créer un mock pour User
        $this->userModel = $this->createMock(User::class);
        $this->authController = new AuthController(null); // Pas de PDO nécessaire ici
        $this->authController->setUserModel($this->userModel);
    }

    /**
     * @runInSeparateProcess
     */
    public function testLoginWithCorrectCredentials()
    {
        // Configurer le mock pour retourner un utilisateur valide
        $this->userModel->method('findUserByEmail')
            ->willReturn([
                'email' => 'admin@arcadia.fr',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role_id' => 1,
                'role' => 'admin'
            ]);

        $this->userModel->method('verifyPassword')
            ->willReturn(true);

        // Exécuter le test
        $this->authController->login('admin@arcadia.fr', 'admin123', true);

        // Vérifier les variables de session
        $this->assertArrayHasKey('email', $_SESSION);
        $this->assertEquals('admin@arcadia.fr', $_SESSION['email']);
        $this->assertEquals('admin', $_SESSION['role']);
    }

    /**
     * @runInSeparateProcess
     */
    public function testLoginWithIncorrectCredentials()
    {
        // Configurer le mock pour retourner un utilisateur valide
        $this->userModel->method('findUserByEmail')
            ->willReturn(null); // Aucun utilisateur trouvé

        $response = $this->authController->login('wrong@example.com', 'wrongpassword', true);

        // Vérifier la réponse
        $this->assertEquals('Email ou mot de passe incorrect.', $response);
    }

    /**
     * @runInSeparateProcess
     */
    public function testSessionRoleAfterLogin()
    {
        // Configurer le mock pour retourner un utilisateur valide
        $this->userModel->method('findUserByEmail')
            ->willReturn([
                'email' => 'admin@arcadia.fr',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role_id' => 1,
                'role' => 'admin'
            ]);

        $this->userModel->method('verifyPassword')
            ->willReturn(true);

        // Exécuter le test
        $this->authController->login('admin@arcadia.fr', 'admin123', true);

        // Vérifier les variables de session
        $this->assertEquals('admin', $_SESSION['role']);
    }
}
