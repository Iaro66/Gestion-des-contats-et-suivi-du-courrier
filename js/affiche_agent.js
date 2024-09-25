document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggle-table-btn");
    const crudTable = document.getElementById("crud-table");

    toggleButton.addEventListener("click", function () {
        if (crudTable.style.display === "none") {
            crudTable.style.display = "table"; 
            toggleButton.textContent = "Cacher le tableau"; 
        } else {
            crudTable.style.display = "none"; 
            toggleButton.textContent = "Afficher le tableau"; 
        }
    });
});

function searchTable() {
    const input = document.getElementById("search-input");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("crud-table");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) { 
        const tds = tr[i].getElementsByTagName("td");
        let match = false;
        
        // Vérification de chaque cellule de la ligne
        for (let j = 0; j < tds.length; j++) {
            const td = tds[j];
            if (td) {
                if (td.textContent.toLowerCase().indexOf(filter) > -1) {
                    match = true; 
                    break;
                }
            }
        }
        
        if (match) {
            tr[i].style.display = ""; // Affiche la ligne
        } else {
            tr[i].style.display = "none"; // Cache la ligne
        }
    }
}
