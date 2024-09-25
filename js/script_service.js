function rechercher() {
    // Récupérer l'entrée de recherche
    const input = document.getElementById('search-input');
    const filter = input.value.toLowerCase();
    
    // Récupérer le tableau et toutes ses lignes
    const table = document.getElementById('batiment-table');
    const rows = table.getElementsByTagName('tr');

    // Parcourir toutes les lignes du tableau, sauf la première (en-tête)
    for (let i = 1; i < rows.length; i++) {
        // Récupérer les cellules de la ligne actuelle
        const cells = rows[i].getElementsByTagName('td');
        let match = false;

        // Vérifier chaque cellule de la ligne
        for (let j = 0; j < cells.length; j++) {
            const cell = cells[j];
            if (cell) {
                const text = cell.textContent || cell.innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
        }

        // Afficher ou masquer la ligne en fonction de la recherche
        if (match) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
