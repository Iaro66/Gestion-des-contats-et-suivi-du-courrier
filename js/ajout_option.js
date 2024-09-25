document.addEventListener('DOMContentLoaded', () => {
    // Fonction pour basculer la visibilité
    function toggleVisibility(elementId) {
        const element = document.getElementById(elementId);
        element.style.display = (element.style.display === 'none') ? 'block' : 'none';
    }

    document.getElementById('show-porte-button').addEventListener('click', () => {
        toggleVisibility('new-porte-container');
    });

    document.getElementById('show-service-button').addEventListener('click', () => {
        toggleVisibility('new-service-container');
    });

    document.getElementById('show-division-button').addEventListener('click', () => {
        toggleVisibility('new-division-container');
    });

    document.getElementById('show-ministere-button').addEventListener('click', () => {
        toggleVisibility('new-ministere-container');
    });
});
