document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.habitat-item button:nth-of-type(1)'); // Boutons de modification
    const deleteButtons = document.querySelectorAll('.habitat-item button:nth-of-type(2)'); // Boutons de suppression
    const editHabitatModal = document.getElementById('editHabitatModal');
    const deleteHabitatModal = document.getElementById('deleteHabitatModal');
    const closeButtons = document.querySelectorAll('.modal .close');
    const cancelButtons = document.querySelectorAll('.btn-cancel');
    let currentHabitatItem = null; // Pour garder une référence à l'élément en cours de modification ou de suppression

    // Ouvrir le modal de modification
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            try {
                currentHabitatItem = this.closest('.habitat-item');
                console.log('Modification de l\'habitat:', currentHabitatItem);

                const title = currentHabitatItem.querySelector('h3').textContent;
                const mainImage = currentHabitatItem.dataset.mainImage;
                const shortDescription = currentHabitatItem.dataset.shortDescription;
                const detailedDescription = currentHabitatItem.dataset.detailedDescription;
                let secondaryImages = currentHabitatItem.dataset.secondaryImages;

                // Correction: Supprimez les guillemets extérieurs de la chaîne JSON si nécessaire
                if (secondaryImages.startsWith('"')) {
                    secondaryImages = secondaryImages.slice(1, -1);
                }

                // Vérifiez si secondaryImages est une chaîne JSON et analysez-la si nécessaire
                try {
                    secondaryImages = JSON.parse(secondaryImages.replace(/\\/g, ''));
                } catch (error) {
                    console.error('Erreur lors du parsing de secondaryImages:', error);
                    secondaryImages = [];
                }

                // Afficher le contenu de secondaryImages pour déboguer
                console.log('secondaryImages après parsing:', secondaryImages);

                // Pré-remplir le formulaire
                document.getElementById('edit-title').value = title;
                document.getElementById('edit-short-description').value = shortDescription;
                document.getElementById('edit-detailed-description').value = detailedDescription;

                if (document.getElementById('current-main-image')) {
                    document.getElementById('current-main-image').src = mainImage;
                }

                // Pré-remplir les images secondaires
                const currentSecondaryImagesContainer = document.getElementById('current-secondary-images');
                if (currentSecondaryImagesContainer) {
                    currentSecondaryImagesContainer.innerHTML = '';
                    secondaryImages.forEach(image => {
                        const imgContainer = document.createElement('div');
                        imgContainer.classList.add('image-entry');
                        const img = document.createElement('img');

                        img.src = image.secondary_image_url;
                        img.style.maxWidth = '30%';
                        img.style.marginRight = '10px';

                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Supprimer';
                        deleteButton.classList.add('btn-delete-image');
                        deleteButton.addEventListener('click', function () {
                            imgContainer.remove();
                        });

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(deleteButton);
                        currentSecondaryImagesContainer.appendChild(imgContainer);
                    });
                }

                editHabitatModal.style.display = 'block';
            } catch (error) {
                console.error('Erreur lors de l\'ouverture du modal de modification:', error);
            }
        });
    });

    // Ouvrir le modal de suppression
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            currentHabitatItem = this.closest('.habitat-item');
            deleteHabitatModal.style.display = 'block';
        });
    });

    // Confirmer la suppression
    document.getElementById('confirmDeleteHabitat').addEventListener('click', function () {
        if (currentHabitatItem) {
            currentHabitatItem.remove();
            deleteHabitatModal.style.display = 'none';
        }
    });

    // Fermer les modals
    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            editHabitatModal.style.display = 'none';
            deleteHabitatModal.style.display = 'none';
        });
    });

    cancelButtons.forEach(button => {
        button.addEventListener('click', function () {
            editHabitatModal.style.display = 'none';
            deleteHabitatModal.style.display = 'none';
        });
    });

    // Fermer le modal si on clique en dehors du contenu
    window.addEventListener('click', function (event) {
        if (event.target === editHabitatModal) {
            editHabitatModal.style.display = 'none';
        } else if (event.target === deleteHabitatModal) {
            deleteHabitatModal.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {

    // Lorsque l'utilisateur clique sur le lien "Voir l'image actuelle"
    const viewMainImageLink = document.getElementById('view-main-image');
    
    // Vérifier si l'élément existe avant de l'utiliser
    if (viewMainImageLink) {
        const imagePreviewModal = document.getElementById('imagePreviewModal');
        const previewImage = document.getElementById('preview-image');
        const closePreviewModal = imagePreviewModal.querySelector('.close');

        // Lorsque l'utilisateur clique sur le lien "Voir l'image actuelle"
        viewMainImageLink.addEventListener('click', function (e) {
            e.preventDefault();
            // Mettre à jour la source de l'image du modal
            previewImage.src = document.getElementById('current-main-image').src;
            // Afficher le modal
            imagePreviewModal.style.display = 'block';
        });

        // Fermer le modal lorsque l'utilisateur clique sur la croix
        closePreviewModal.addEventListener('click', function () {
            imagePreviewModal.style.display = 'none';
        });

        // Fermer le modal lorsqu'on clique en dehors du contenu
        window.addEventListener('click', function (event) {
            if (event.target === imagePreviewModal) {
                imagePreviewModal.style.display = 'none';
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Gérer la prévisualisation des images secondaires
    const secondaryImagePreviewModal = document.getElementById('secondaryImagePreviewModal');
    const secondaryPreviewImage = document.getElementById('secondary-preview-image');
    const closeSecondaryPreviewModal = secondaryImagePreviewModal.querySelector('.close');

    // Ajouter un événement pour chaque image secondaire
    document.getElementById('current-secondary-images').addEventListener('click', function (e) {
        if (e.target.tagName === 'IMG') {
            secondaryPreviewImage.src = e.target.src;
            secondaryImagePreviewModal.style.display = 'block';
        }
    });

    // Fermer le modal lorsque l'utilisateur clique sur la croix
    closeSecondaryPreviewModal.addEventListener('click', function () {
        secondaryImagePreviewModal.style.display = 'none';
    });

    // Fermer le modal lorsqu'on clique en dehors du contenu
    window.addEventListener('click', function (event) {
        if (event.target === secondaryImagePreviewModal) {
            secondaryImagePreviewModal.style.display = 'none';
        }
    });
});
