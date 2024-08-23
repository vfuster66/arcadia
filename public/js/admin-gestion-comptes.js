document.addEventListener('DOMContentLoaded', function() {
    const filterSearch = document.getElementById('filter-search');
    const filterRole = document.getElementById('filter-role');
    const accountItems = document.querySelectorAll('.account-item');

    function filterAccounts() {
        const searchValue = filterSearch.value.toLowerCase();
        const roleValue = filterRole.value.toLowerCase();

        accountItems.forEach(item => {
            const name = item.getAttribute('data-name').toLowerCase();
            const email = item.getAttribute('data-email').toLowerCase();
            const role = item.getAttribute('data-role').toLowerCase();

            if (
                (name.includes(searchValue) || email.includes(searchValue)) && 
                (role.includes(roleValue) || roleValue === '')
            ) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    filterSearch.addEventListener('input', filterAccounts);
    filterRole.addEventListener('change', filterAccounts);
});

document.addEventListener('DOMContentLoaded', function() {
    var editModal = document.getElementById("editModal");
    var deleteModal = document.getElementById("deleteModal");
    var editBtns = document.querySelectorAll(".btn-edit");
    var deleteBtns = document.querySelectorAll(".btn-delete");
    var spanClose = document.getElementsByClassName("close");
    var cancelBtn = document.querySelector(".btn-cancel");

    // Ouvrir le modal de modification
    editBtns.forEach(function(btn) {
        btn.onclick = function() {
            var accountItem = this.parentElement;
            var userId = accountItem.getAttribute("data-id"); // Récupérer l'ID de l'utilisateur
            var username = accountItem.getAttribute("data-name");
            var email = accountItem.getAttribute("data-email");
            var role = accountItem.getAttribute("data-role");
            var nom = accountItem.getAttribute("data-nom");
            var prenom = accountItem.getAttribute("data-prenom");

            document.getElementById("edit-user-id").value = userId; // Remplir le champ caché avec l'ID de l'utilisateur
            document.getElementById("edit-name").value = username;
            document.getElementById("edit-email").value = email;
            document.getElementById("edit-role").value = role;
            document.getElementById("edit-nom").value = nom;
            document.getElementById("edit-prenom").value = prenom;

            editModal.style.display = "block";
        };
    });

    // Ouvrir le modal de suppression
    deleteBtns.forEach(function(btn) {
        btn.onclick = function() {
            var accountItem = this.parentElement;
            var accountId = accountItem.getAttribute("data-id");
    
            document.getElementById("delete-account-id").value = accountId; // Remplir l'ID dans le formulaire de suppression
            deleteModal.style.display = "block";
        }
    });    

    // Fermer le modal de modification
    spanClose[0].onclick = function() {
        editModal.style.display = "none";
    };

    // Fermer le modal de suppression
    spanClose[1].onclick = function() {
        deleteModal.style.display = "none";
    };

    // Annuler la suppression
    cancelBtn.onclick = function() {
        deleteModal.style.display = "none";
    };

    // Fermer les modals si on clique en dehors du contenu
    window.onclick = function(event) {
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
        if (event.target == deleteModal) {
            deleteModal.style.display = "none";
        }
    };
});
