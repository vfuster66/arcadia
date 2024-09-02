<?php
require_once __DIR__ . '/config/db.php';

// Récupérer les utilisateurs avec des mots de passe en clair (longueur < 60)
$query = "SELECT email, password_hash FROM utilisateur WHERE LENGTH(password_hash) < 60";
$stmt = $pdo->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    // Hachage du mot de passe en clair
    $hashedPassword = password_hash($user['password_hash'], PASSWORD_DEFAULT);

    // Mise à jour du mot de passe haché dans la base de données
    $updateQuery = "UPDATE utilisateur SET password_hash = :password WHERE email = :email";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(':password', $hashedPassword);
    $updateStmt->bindParam(':email', $user['email']);
    $updateStmt->execute();

    echo "Mot de passe de l'utilisateur avec l'email " . $user['email'] . " a été haché.\n";
}
?>
