document.addEventListener('DOMContentLoaded', function () {
    const editServiceModal = document.getElementById('editServiceModal');
    const addEditExtraInfoBtn = document.getElementById('add-edit-extra-info-btn');
    const editExtraInfoContainer = document.getElementById('edit-extra-info-container');
    const currentServiceImage = document.getElementById('current-service-image');
    const viewServiceImageLink = document.getElementById('view-service-image');
    let extraInfoCount = 0;

    // Fonction pour ajouter une nouvelle information supplémentaire
    function addExtraInfo(title = '', text = '') {
        extraInfoCount++;
        const extraInfoItem = document.createElement('div');
        extraInfoItem.classList.add('extra-info-item');
        extraInfoItem.innerHTML = `
            <label for="edit-extra-title-${extraInfoCount}">Titre de l'information</label>
            <input type="text" id="edit-extra-title-${extraInfoCount}" name="edit-extra-title[]" value="${title}" required>
            
            <label for="edit-extra-text-${extraInfoCount}">Texte</label>
            <textarea id="edit-extra-text-${extraInfoCount}" name="edit-extra-text[]" rows="2" required>${text}</textarea>

            <button type="button" class="btn-delete-extra-info">Supprimer</button>
        `;
        editExtraInfoContainer.appendChild(extraInfoItem);

        // Ajouter un événement pour supprimer cette information supplémentaire
        extraInfoItem.querySelector('.btn-delete-extra-info').addEventListener('click', function () {
            extraInfoItem.remove();
        });
    }

    // Bouton pour ajouter une nouvelle information supplémentaire
    addEditExtraInfoBtn.addEventListener('click', function () {
        addExtraInfo();
    });

    // Exemple pour pré-remplir les informations supplémentaires existantes (si vous récupérez des données depuis la base)
    function prefillExtraInfo(extraInfoArray) {
        extraInfoArray.forEach(info => {
            addExtraInfo(info.title, info.text);
        });
    }

    // Fonction pour ouvrir le modal avec les informations du service
    function openEditModal(serviceData) {
        document.getElementById('edit-service-name').value = serviceData.name;
        document.getElementById('edit-service-description').value = serviceData.description;
        editExtraInfoContainer.innerHTML = ''; // Clear existing extra info items
        prefillExtraInfo(serviceData.extraInfo); // Refill with new data

        // Gérer l'image du service
        currentServiceImage.src = serviceData.image;
        viewServiceImageLink.href = serviceData.image;

        editServiceModal.style.display = 'block';
    }

    // Événement pour ouvrir le modal au clic sur le bouton "Modifier"
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const serviceItem = this.closest('.service-item');
            const serviceData = {
                name: serviceItem.dataset.name,
                description: serviceItem.dataset.description,
                image: serviceItem.dataset.image, // Assurez-vous que l'image est bien définie ici
                extraInfo: [] // Remplir ici avec les données réelles si disponibles
            };
            openEditModal(serviceData);
        });
    });

    // Gestion de la fermeture du modal
    document.querySelectorAll('.modal .close, .btn-cancel').forEach(button => {
        button.addEventListener('click', function () {
            editServiceModal.style.display = 'none';
        });
    });

    // Fermer le modal si on clique en dehors du contenu
    window.addEventListener('click', function (event) {
        if (event.target === editServiceModal) {
            editServiceModal.style.display = 'none';
        }
    });
});
