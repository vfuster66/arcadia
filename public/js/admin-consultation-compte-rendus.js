document.addEventListener("DOMContentLoaded", function() {
    const filterDate = document.getElementById("filter-date");
    const filterSearch = document.getElementById("filter-search");
    const reportRows = document.querySelectorAll("table tbody tr");

    function formatDate(dateString) {
        const [day, month, year] = dateString.split('/');
        return `${year}-${month}-${day}`;
    }

    function filterReports() {
        const dateValue = filterDate.value;
        const searchValue = filterSearch.value.toLowerCase();

        reportRows.forEach(row => {
            const date = formatDate(row.cells[0].textContent.trim());
            const vet = row.cells[1].textContent.toLowerCase().trim();
            const animal = row.cells[2].textContent.toLowerCase().trim();
            const species = row.cells[3].textContent.toLowerCase().trim();

            const dateMatch = !dateValue || date === dateValue;
            const searchMatch = vet.includes(searchValue) || animal.includes(searchValue) || species.includes(searchValue);

            if (dateMatch && searchMatch) {
                row.style.display = "table-row";  // Afficher la ligne si les filtres correspondent
            } else {
                row.style.display = "none";  // Cacher la ligne si les filtres ne correspondent pas
            }
        });
    }

    // Ajouter des écouteurs d'événements sur les filtres
    filterDate.addEventListener("input", filterReports);
    filterSearch.addEventListener("input", filterReports);
});
