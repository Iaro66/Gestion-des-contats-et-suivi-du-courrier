document.addEventListener('DOMContentLoaded', function () {
    const classerPopup = document.getElementById('classer-popup');
    const classerForm = document.getElementById('classer-form');
    const classerClose = document.getElementById('classer-close');

    if (classerPopup && classerForm && classerClose) {
        // Ouvrir le popup de classement
        document.querySelectorAll('.classer-btn').forEach(button => {
            button.addEventListener('click', function () {
                const courrierId = this.dataset.id;
                if (courrierId) {
                    document.getElementById('classer-id').value = courrierId;
                    classerPopup.classList.remove('popup-hidden');
                } else {
                    console.error('ID de courrier manquant pour le bouton de classement.');
                }
            });
        });

        // Fermer le popup de classement
        classerClose.addEventListener('click', function () {
            classerPopup.classList.add('popup-hidden');
        });

        // Soumettre le formulaire de classement
        classerForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('classer_courrier.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(text => {
                if (text === 'success') {
                    alert('Courrier classé avec succès!');
                    classerPopup.classList.add('popup-hidden');
                    location.reload();
                } else {
                    alert('Erreur lors du classement: ' + text);
                }
            })
            .catch(error => console.error('Erreur lors de la requête fetch:', error));
        });
    } else {
        console.error('Un ou plusieurs éléments requis pour le classement sont manquants dans le DOM.');
    }
});
