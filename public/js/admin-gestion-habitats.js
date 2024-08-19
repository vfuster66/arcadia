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
            currentHabitatItem = this.closest('.habitat-item');
            const title = currentHabitatItem.querySelector('h3').textContent;
            const mainImage = currentHabitatItem.dataset.mainImage;
            const shortDescription = currentHabitatItem.dataset.shortDescription;
            const detailedDescription = currentHabitatItem.dataset.detailedDescription;
            const secondaryImages = JSON.parse(currentHabitatItem.dataset.secondaryImages);
            const animals = JSON.parse(currentHabitatItem.dataset.animals);

            // Pré-remplir le formulaire
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-short-description').value = shortDescription;
            document.getElementById('edit-detailed-description').value = detailedDescription;
            document.getElementById('current-main-image').src = mainImage;

            // Pré-remplir les images secondaires
            const currentSecondaryImagesContainer = document.getElementById('current-secondary-images');
            currentSecondaryImagesContainer.innerHTML = '';
            secondaryImages.forEach(image => {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('image-entry');
                const img = document.createElement('img');
                img.src = image;
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

            // Pré-remplir la liste des animaux avec des boutons "Modifier" et "Supprimer"
            const editAnimalsList = document.getElementById('edit-animals-list');
            editAnimalsList.innerHTML = '';
            animals.forEach((animal, index) => {
                const animalItem = document.createElement('div');
                animalItem.classList.add('animal-item');
                animalItem.innerHTML = `
                    <h4>${animal.name} - ${animal.species}</h4>
                    <button class="btn-edit-animal">Modifier</button>
                    <button class="btn-delete-animal">Supprimer</button>
                `;
                
                // Bouton "Modifier" pour chaque animal
                animalItem.querySelector('.btn-edit-animal').addEventListener('click', function () {
                    // Ouvrir un autre modal ou remplir un formulaire spécifique pour cet animal
                    // Utiliser les données de l'animal pour pré-remplir le formulaire de modification d'animal
                    document.getElementById('edit-animal-name').value = animal.name;
                    document.getElementById('edit-animal-species').value = animal.species;
                    document.getElementById('edit-animal-details').value = animal.details;
                    // Afficher la photo actuelle si disponible
                    // Si vous avez un modal séparé pour les animaux, vous pouvez l'ouvrir ici
                });

                // Bouton "Supprimer" pour chaque animal
                animalItem.querySelector('.btn-delete-animal').addEventListener('click', function () {
                    animalItem.remove();
                });

                editAnimalsList.appendChild(animalItem);
            });

            editHabitatModal.style.display = 'block';
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
    const accordionHeaders = document.querySelectorAll('.accordion-header');

    accordionHeaders.forEach(header => {
        header.addEventListener('click', function () {
            const accordionItem = this.parentElement;

            // Toggle active class
            accordionItem.classList.toggle('active');
        });
    });

    // Ajout dynamique des animaux
    const animalsContainer = document.getElementById('animals-container');
    const addAnimalBtn = document.getElementById('add-animal-btn');
    let animalCount = 1;
    const maxAnimals = 3;

    addAnimalBtn.addEventListener('click', function () {
        if (animalCount < maxAnimals) {
            animalCount++;

            const newAnimalEntry = document.createElement('div');
            newAnimalEntry.classList.add('animal-entry');
            newAnimalEntry.innerHTML = `
                <label for="animal-name-${animalCount}">Nom de l'Animal</label>
                <input type="text" id="animal-name-${animalCount}" name="animal-name[]" required>

                <label for="animal-species-${animalCount}">Espèce</label>
                <input type="text" id="animal-species-${animalCount}" name="animal-species[]" required>

                <label for="animal-details-${animalCount}">Détails</label>
                <textarea id="animal-details-${animalCount}" name="animal-details[]" rows="2" required></textarea>

                <label for="animal-photo-${animalCount}">Photo</label>
                <input type="file" id="animal-photo-${animalCount}" name="animal-photo[]" accept="image/*" required>
            `;

            animalsContainer.appendChild(newAnimalEntry);

            if (animalCount === maxAnimals) {
                addAnimalBtn.disabled = true;
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const viewMainImageLink = document.getElementById('view-main-image');
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
});
