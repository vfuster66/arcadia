document.addEventListener('DOMContentLoaded', function () {
    // Références aux modals d'édition et de suppression
    const editServiceModal = document.getElementById('editServiceModal');
    const deleteServiceModal = document.getElementById('deleteServiceModal');
    const currentServiceImage = document.getElementById('current-service-image');
    let extraInfoCount = 0;

    // Fonction pour ouvrir le modal d'édition
    function openEditModal(serviceData) {
        document.getElementById('edit-service-id').value = serviceData.id;
        document.getElementById('edit-service-name').value = serviceData.name;
        document.getElementById('edit-service-description').value = serviceData.description;
        document.getElementById('edit-service-type').value = serviceData.type;
        document.getElementById('edit-service-horaires').value = serviceData.horaires;
        document.getElementById('edit-service-prix').value = serviceData.prix;

        // Afficher l'image principale du service
        if (serviceData.image) {
            currentServiceImage.src = serviceData.image;
            currentServiceImage.style.display = 'block';
        } else {
            currentServiceImage.style.display = 'none';
        }

        // Afficher les détails supplémentaires (service_details)
        const extraInfoContainer = document.getElementById('edit-extra-info-container');
        extraInfoContainer.innerHTML = ''; // Vide le conteneur avant d'ajouter de nouveaux éléments

        serviceData.details.forEach((detail, index) => {
            const detailElement = `
                <div class="extra-info-item">
                    <label for="extra-title-${index}">Titre de l'information</label>
                    <input type="text" id="extra-title-${index}" name="extra-title[]" value="${detail.section_title}" required>
                    
                    <label for="extra-text-${index}">Texte</label>
                    <textarea id="extra-text-${index}" name="extra-text[]" rows="2" required>${detail.section_content}</textarea>

                    <!-- Afficher l'image secondaire si elle existe -->
                    ${detail.image_path ? `<img src="${detail.image_path}" alt="Image du service" style="max-width: 100%; margin-top: 10px;">` : ''}
                </div>
            `;
            extraInfoContainer.insertAdjacentHTML('beforeend', detailElement);
        });

        editServiceModal.style.display = 'block';
    }

    // Fonction pour ouvrir le modal de suppression
    function openDeleteModal(serviceId) {
        document.getElementById('delete-service-id').value = serviceId;
        deleteServiceModal.style.display = 'block';
    }

    // Fonction pour ajouter dynamiquement des informations supplémentaires dans le modal d'édition
    const addExtraInfoButton = document.getElementById('add-edit-extra-info-btn');
    addExtraInfoButton.addEventListener('click', function () {
        const extraInfoContainer = document.getElementById('edit-extra-info-container');
        const newExtraInfo = `
            <div class="extra-info-item">
                <label for="extra-title-${extraInfoCount}">Titre de l'information</label>
                <input type="text" id="extra-title-${extraInfoCount}" name="extra-title[]" required>

                <label for="extra-text-${extraInfoCount}">Texte</label>
                <textarea id="extra-text-${extraInfoCount}" name="extra-text[]" rows="2" required></textarea>
            </div>
        `;
        extraInfoContainer.insertAdjacentHTML('beforeend', newExtraInfo);
        extraInfoCount++;
    });

    // Événement pour ouvrir le modal d'édition
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const serviceItem = this.closest('.service-item');
            const serviceData = {
                id: serviceItem.dataset.id,
                name: serviceItem.dataset.name,
                description: serviceItem.dataset.description,
                type: serviceItem.dataset.type,
                horaires: serviceItem.dataset.horaires,
                prix: serviceItem.dataset.prix,
                image: serviceItem.dataset.image,
                details: JSON.parse(serviceItem.dataset.details) // Assure-toi que les détails sont au format JSON
            };
            openEditModal(serviceData);
        });
    });

    // Événement pour ouvrir le modal de suppression
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const serviceItem = this.closest('.service-item');
            const serviceId = serviceItem.dataset.id;
            openDeleteModal(serviceId);
        });
    });

    // Gestion de la fermeture des modals (édition et suppression) avec le bouton "Fermer" (X)
    const closeButtons = document.querySelectorAll('.modal .close');
    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            editServiceModal.style.display = 'none';
            deleteServiceModal.style.display = 'none';
        });
    });

    // Gestion de l'annulation des actions (fermeture du modal de suppression ou d'édition)
    const cancelButtons = document.querySelectorAll('.btn-cancel');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function () {
            editServiceModal.style.display = 'none';
            deleteServiceModal.style.display = 'none';
        });
    });

    // Soumission du formulaire de suppression
    const deleteForm = deleteServiceModal.querySelector('form');
    deleteForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Empêcher l'envoi par défaut pour vérifier
        this.submit(); // Soumettre le formulaire après la confirmation
    });

    // Soumission du formulaire d'édition
    const editForm = document.getElementById('editServiceForm');
    editForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Empêcher l'envoi automatique pour vérifier les données

        // Effectuer toute validation supplémentaire ici si nécessaire
        console.log(this.action);

        this.submit(); // Soumettre le formulaire si tout est correct
    });
});
