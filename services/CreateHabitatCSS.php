<?php

function createHabitatCSS($nomHabitat) {
    // Convertir le nom de l'habitat en nom de fichier CSS (par exemple, "La Jungle" devient "jungle.css")
    $filename = strtolower(str_replace(' ', '_', $nomHabitat)) . '.css';
    $filePath = __DIR__ . '/../public/css/' . $filename;

    // Nom de l'habitat utilisé dans les IDs et les classes
    $habitatID = strtolower(str_replace(' ', '-', $nomHabitat));

    // Contenu du fichier CSS à créer
    $cssContent = <<<CSS

/* Styles globaux */
body {
    font-family: 'Nunito', sans-serif;
    background-color: #FFFDE7;
    color: #212121;
    margin: 0;
    padding: 0;
}

/* Container principal */
.main-container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
}

/* Titre principal */
h1 {
    font-family: 'Poppins', sans-serif;
    font-size: 36px;
    color: #5D4037;
    text-align: center;
    margin-bottom: 40px;
    margin-top: 40px;
}

/* Section description de l'habitat */
#description p {
    font-size: 18px;
    color: #212121;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* Galerie de photos de l'habitat */
.photo-gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 40px;
}

.photo-gallery img {
    width: 100%;
    max-width: calc(33.333% - 20px);
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
}

/* Grille pour les cartes */
.animal-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 40px;
}

/* Styles pour les cartes */
.animal-card {
    flex: 1 1 calc(33.333% - 80px);
    max-width: calc(33.333% - 40px);
    perspective: 1000px;
    margin-bottom: 80px;
}

.animal-card-inner {
    position: relative;
    width: 100%;
    padding-top: 100%;
    transition: transform 0.6s;
    transform-style: preserve-3d;
    transform-origin: center;
}

.animal-card:hover .animal-card-inner {
    transform: rotateY(180deg);
}

/* Avant de la carte */
.animal-card-front {
    background-color: #A8BCAA;
    z-index: 1;
}

.animal-card-front img {
    width: 180px;
    height: 180px;
    border-radius: 10px;
    margin-bottom: 15px;
    object-fit: cover;
}

.animal-card-front h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 24px;
    color: #5D4037;
    margin-bottom: 10px;
}

.animal-card-front p {
    font-size: 18px;
    color: #212121;
}

/* Arrière de la carte */
.animal-card-back {
    background-color: #5D4037;
    color: #FFFDE7;
    transform: rotateY(180deg);
    z-index: 2;
    padding: 10px;
}

.animal-card-back h4 {
    font-family: 'Poppins', sans-serif;
    font-size: 22px;
    margin-bottom: 10px;
    color: #FFFDE7;
}

.animal-card-back p {
    font-size: 16px;
    text-align: center;
}

/* Media queries pour tablette (entre 768px et 1024px) */
@media (max-width: 1024px) {
    .main-container {
        padding: 15px;
    }

    h1 {
        font-size: 32px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    #photos-{$habitatID} .photo-gallery img {
        max-width: calc(50% - 10px); /* Deux images par ligne */
    }

    #{$habitatID}-animaux .animal-cards {
        gap: 30px;
    }

    .animal-card {
        flex: 1 1 calc(50% - 30px); /* Deux cartes par ligne */
        max-width: calc(50% - 20px);
    }
}

/* Media queries pour mobile (moins de 768px) */
@media (max-width: 768px) {
    .main-container {
        padding: 10px;
    }

    h1 {
        font-size: 28px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .photo-gallery {
        gap: 10px;
    }

    .photo-gallery img {
        max-width: 100%; /* Une seule image par ligne */
    }

    .animal-cards {
        gap: 20px;
    }

    .animal-card {
        flex: 1 1 100%; /* Une carte par ligne */
        max-width: 100%;
    }

    .animal-card-front img {
        width: 150px;
        height: 150px;
    }

    .animal-card-front h3 {
        font-size: 20px;
    }

    .animal-card-front p,
    .animal-card-back p {
        font-size: 16px;
    }

    .animal-card-back h4 {
        font-size: 18px;
    }
}

/* Media queries pour petits appareils (moins de 480px) */
@media (max-width: 480px) {
    h1, h2 {
        font-size: 24px;
    }

    #photos-{$habitatID} .photo-gallery img {
        width: calc(100% - 20px);
    }

    .animal-card {
        flex: 1 1 100%;
        max-width: 100%;
        margin-bottom: 30px;
    }

    .animal-card-front img {
        width: 150px;
        height: 150px;
    }

    .animal-card-front h3 {
        font-size: 20px;
    }

    .animal-card-front p,
    .animal-card-back p {
        font-size: 14px;
    }

    .animal-card-back h4 {
        font-size: 18px;
    }
}
CSS;

    file_put_contents($filePath, $cssContent);
}

?>