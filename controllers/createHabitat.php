<?php
require '/../services/createHabitatPage.php';
require 'createHabitatCSS.php';

// Exemple de données pour un habitat
$nomHabitat = "La Jungle";
$descriptionRapide = "Explorez l'épaisse végétation...";
$descriptionDetaillee = "La jungle est un écosystème luxuriant...";
$images = [
    ['image_path' => 'jungle1.jpg', 'alt_text' => 'Image de la jungle 1'],
    ['image_path' => 'jungle2.jpg', 'alt_text' => 'Image de la jungle 2'],
];
$animaux = [
    // Informations sur les animaux associés
];

// Créer la page de l'habitat
createHabitatPage($nomHabitat, $descriptionRapide, $descriptionDetaillee, $images, $animaux);

// Créer le fichier CSS correspondant
createHabitatCSS($nomHabitat);

?>
