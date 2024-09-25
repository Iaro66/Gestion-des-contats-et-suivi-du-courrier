document.addEventListener('DOMContentLoaded', function() {
    var closeButtons = document.querySelectorAll('.close-btn');
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            this.parentElement.style.display = 'none';
        });
    });
});

function rechercherBatiments() {
    // Récupère la valeur du champ de recherche
    const input = document.getElementById('search-input');
    const filter = input.value.toLowerCase();
    
    // Récupère toutes les lignes du tableau
    const table = document.getElementById('table');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    // Parcours de toutes les lignes du tableau
    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let match = false;
        
        // Vérifie chaque cellule de la ligne
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }
        
        // Affiché ou masqué la ligne en fonction de la correspondance
        if (match) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
