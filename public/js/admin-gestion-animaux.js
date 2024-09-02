document.addEventListener('DOMContentLoaded', function () {
    const editAnimalButtons = document.querySelectorAll('.edit-animal');
    const deleteAnimalButtons = document.querySelectorAll('.delete-animal');

    const editAnimalModal = document.getElementById('editAnimalModal');
    const deleteAnimalModal = document.getElementById('deleteAnimalModal');

    const closeButtons = document.querySelectorAll('.modal .close');
    const cancelButtons = document.querySelectorAll('.btn-cancel');

    let currentAnimalItem = null;

    // Ouvrir le modal de modification
    editAnimalButtons.forEach(button => {
        button.addEventListener('click', function () {
            currentAnimalItem = this.closest('.animal-item');
            const animalId = currentAnimalItem.getAttribute('data-id');
            const name = currentAnimalItem.getAttribute('data-name');
            const species = currentAnimalItem.getAttribute('data-species');
            const details = currentAnimalItem.getAttribute('data-details');

            document.getElementById('edit-animal-id').value = animalId;
            document.getElementById('edit-animal-name').value = name;
            document.getElementById('edit-animal-species').value = species;
            document.getElementById('edit-animal-details').value = details;

            editAnimalModal.style.display = 'block';
        });
    });

    // Ouvrir le modal de suppression
    deleteAnimalButtons.forEach(button => {
        button.addEventListener('click', function () {
            currentAnimalItem = this.closest('.animal-item');
            const animalId = currentAnimalItem.getAttribute('data-id');

            document.getElementById('delete-animal-id').value = animalId;
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

    // Fermer le modal si on clique en dehors de celui-ci
    window.addEventListener('click', function (event) {
        if (event.target === editAnimalModal) {
            editAnimalModal.style.display = 'none';
        } else if (event.target === deleteAnimalModal) {
            deleteAnimalModal.style.display = 'none';
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const filterSearch = document.getElementById("filter-search");
    const filterHabitat = document.getElementById("filter-habitat");
    const animalItems = document.querySelectorAll(".animal-item");

    function filterAnimals() {
        const searchValue = filterSearch.value.toLowerCase();
        const habitatValue = filterHabitat.value.toLowerCase();

        animalItems.forEach(item => {
            const name = item.getAttribute("data-name").toLowerCase();
            const species = item.getAttribute("data-species").toLowerCase();
            const habitat = item.getAttribute("data-habitat").toLowerCase();

            const matchesSearch = (name.includes(searchValue) || species.includes(searchValue));
            const matchesHabitat = (habitatValue === "" || habitat.includes(habitatValue));

            if (matchesSearch && matchesHabitat) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    }

    filterSearch.addEventListener("input", filterAnimals);
    filterHabitat.addEventListener("change", filterAnimals);
});
