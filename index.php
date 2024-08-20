<?php
// /public/index.php

// Vérifier si une action est passée dans l'URL, sinon, définir l'action par défaut sur "accueil"
$action = $_GET['action'] ?? 'accueil';

// Rediriger vers la page appropriée en fonction de l'action
switch ($action) {
    case 'accueil':
        require '../app/views/accueil.php';
        break;

    case 'services':
        require '../app/views/services.php';
        break;

    case 'train':
        require '../app/views/train.php';
        break;

    case 'habitats':
        require '../app/views/habitats.php';
        break;

    case 'connexion':
        require '../app/views/connexion.php';
        break;

    case 'contact':
        require '../app/views/contact.php';
        break;

    default:
        // Si l'action n'est pas reconnue, rediriger vers une page 404 ou une page d'accueil par défaut
        require '../app/views/404.php';
        break;
}
?>
