document.addEventListener('DOMContentLoaded', function () {
    const archiverPopup = document.getElementById('archiver-popup');
    const archiverForm = document.getElementById('archiver-form');
    const archiverClose = document.getElementById('archiver-close');

    if (archiverPopup && archiverForm && archiverClose) {
        // Ouvrir le popup d'archivage
        document.querySelectorAll('.archiver-btn').forEach(button => {
            button.addEventListener('click', function () {
                const courrierId = this.dataset.id;
                if (courrierId) {
                    document.getElementById('archiver-id').value = courrierId;
                    archiverPopup.classList.remove('popup-hidden');
                } else {
                    console.error('Data ID is missing for the archive button.');
                }
            });
        });

        // Fermer le popup d'archivage
        archiverClose.addEventListener('click', function () {
            archiverPopup.classList.add('popup-hidden');
        });

        // Soumettre le formulaire d'archivage
        archiverForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch('archiver_courrier.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(text => {
                if (text === 'success') {
                    alert('Courrier archivé avec succès!');
                    archiverPopup.classList.add('popup-hidden');
                    location.reload();
                } else {
                    alert('Erreur lors de l\'archivage!');
                }
            })
            .catch(error => console.error('Erreur de fetch:', error));
        });
    } else {
        console.error('Un ou plusieurs éléments requis pour l\'archivage sont manquants dans le DOM.');
    }
});
