document.addEventListener('DOMContentLoaded', () => {
    const searchBar = document.querySelector('.search-bar');
    const tableBody = document.getElementById('courrier-table-body');
    const form = document.getElementById('form-courrier');
    const popupContainer = document.getElementById('popup-container');
    const popupMessage = document.getElementById('popup-message');
    const popupClose = document.getElementById('popup-close');

    // Fonction pour afficher un message en popup
    function showPopup(message, type) {
        popupMessage.textContent = message;
        popupContainer.className = 'popup-hidden'; 
        popupContainer.classList.add('show', type); 

        // Ajouter une classe pour définir le style du popup en fonction du type
        popupContainer.classList.remove('success', 'error');
        popupContainer.classList.add(type);

        // Réinitialiser l'opacité et la transformation pour l'animation
        setTimeout(() => {
            popupContainer.style.opacity = '1';
            popupContainer.style.transform = 'translate(-50%, -50%) scale(1.05)';
        }, 10); 

        setTimeout(() => {
            popupContainer.style.opacity = '0';
            popupContainer.style.transform = 'translate(-50%, -50%) scale(1)';
            setTimeout(() => {
                popupContainer.classList.remove('show');
                if (type === 'success') {
                    window.location.href = 'index.php';
                }
            }, 300); 
        }, 5000); 
    }

    // Fonction pour fermer le popup
    popupClose.addEventListener('click', () => {
        popupContainer.style.opacity = '0';
        popupContainer.style.transform = 'translate(-50%, -50%) scale(1)';
        setTimeout(() => {
            popupContainer.classList.remove('show');
        }, 300);
    });

    // Gestion de la soumission du formulaire
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(form);

        fetch('traitement_courrier.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    showPopup(result.message, 'success');
                } else {
                    showPopup(result.message, 'error');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showPopup('Une erreur est survenue lors de l\'ajout du courrier.', 'error');
            });
    });
});
