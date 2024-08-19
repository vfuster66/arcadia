document.addEventListener("DOMContentLoaded", function() {
    const filterSearch = document.getElementById("filter-search");
    const filterHabitat = document.getElementById("filter-habitat");
    const animalItems = document.querySelectorAll(".animal-item");

    function filterAnimals() {
        const searchValue = filterSearch.value.toLowerCase();
        const habitatValue = filterHabitat.value;

        animalItems.forEach(item => {
            const name = item.getAttribute("data-name").toLowerCase();
            const species = item.getAttribute("data-species").toLowerCase();
            const habitat = item.getAttribute("data-habitat");

            if (
                (name.includes(searchValue) || species.includes(searchValue) || !searchValue) &&
                (habitat === habitatValue || !habitatValue)
            ) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    }

    // Ajouter des écouteurs d'événements sur les filtres
    filterSearch.addEventListener("input", filterAnimals);
    filterHabitat.addEventListener("change", filterAnimals);
});

document.addEventListener('DOMContentLoaded', function () {
    const editAnimalButtons = document.querySelectorAll('.animal-item button:nth-of-type(1)');
    const deleteAnimalButtons = document.querySelectorAll('.animal-item button:nth-of-type(2)');

    const editAnimalModal = document.getElementById('editAnimalModal');
    const deleteAnimalModal = document.getElementById('deleteAnimalModal');

    const closeButtons = document.querySelectorAll('.modal .close');
    const cancelButtons = document.querySelectorAll('.btn-cancel');

    let currentAnimalItem = null;

    // Ouvrir le modal de modification
    editAnimalButtons.forEach(button => {
        button.addEventListener('click', function () {
            currentAnimalItem = this.closest('.animal-item');
            const name = currentAnimalItem.getAttribute('data-name');
            const species = currentAnimalItem.getAttribute('data-species');
            const details = currentAnimalItem.querySelector('h3').textContent.split('-')[1].trim();
            const photoSrc = currentAnimalItem.getAttribute('data-photo'); // Assumez que vous avez l'URL de la photo dans un attribut data-photo

            document.getElementById('edit-animal-name').value = name;
            document.getElementById('edit-animal-species').value = species;
            document.getElementById('edit-animal-details').value = details;

            // Afficher la photo actuelle
            document.getElementById('current-animal-photo').src = photoSrc;

            editAnimalModal.style.display = 'block';
        });
    });

    // Gérer la prévisualisation de la nouvelle photo
    document.getElementById('edit-animal-photo').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('current-animal-photo').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Ouvrir le modal de suppression
    deleteAnimalButtons.forEach(button => {
        button.addEventListener('click', function () {
            currentAnimalItem = this.closest('.animal-item');
            deleteAnimalModal.style.display = 'block';
        });
    });

    // Fermer les modals
    closeButtons.forEach(button => {
        button.addEventListener('click', function () {
            editAnimalModal.style.display = 'none';
            deleteAnimalModal.style.display = 'none';
        });
    });

    cancelButtons.forEach(button => {
        button.addEventListener('click', function () {
            editAnimalModal.style.display = 'none';
            deleteAnimalModal.style.display = 'none';
        });
    });

    // Gérer la soumission du formulaire de modification
    document.getElementById('editAnimalForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const name = document.getElementById('edit-animal-name').value;
        const species = document.getElementById('edit-animal-species').value;
        const details = document.getElementById('edit-animal-details').value;

        currentAnimalItem.setAttribute('data-name', name);
        currentAnimalItem.setAttribute('data-species', species);
        currentAnimalItem.querySelector('h3').textContent = `${name} - ${species} (${currentAnimalItem.getAttribute('data-habitat')})`;

        editAnimalModal.style.display = 'none';
    });

    // Gérer la suppression de l'animal
    document.getElementById('confirmDeleteAnimal').addEventListener('click', function () {
        currentAnimalItem.remove();
        deleteAnimalModal.style.display = 'none';
    });

    // Fermer le modal si on clique en dehors de celui-ci
    window.addEventListener('click', function (event) {
        if (event.target === editAnimalModal) {
            editAnimalModal.style.display = 'none';
        } else if (event.target === deleteAnimalModal) {
            deleteAnimalModal.style.display = 'none';
        }
    });
});
