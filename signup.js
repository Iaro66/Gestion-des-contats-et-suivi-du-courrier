document.addEventListener('DOMContentLoaded', () => {
    const errorModal = document.getElementById('errorModal');
    const errorMessage = document.getElementById('errorMessage');
    const closeModal = document.querySelector('.close');
    const successModal = document.getElementById('successModal'); // Ajouter un élément modal pour le succès
    const successMessage = document.getElementById('successMessage'); // Ajouter un élément pour le message de succès

    // Fonction pour afficher les messages d'erreur
    function showError(message) {
        errorMessage.textContent = message;
        errorModal.style.display = 'block';
    }

    // Fonction pour afficher le message de succès
    function showSuccess(message) {
        successMessage.textContent = message;
        successModal.style.display = 'block';
        setTimeout(() => {
            window.location.href = 'index.php'; // Redirection après la fermeture du modal
        }, 2000); // Temps pour afficher le message de succès avant la redirection
    }

    // Fermer les modaux
    closeModal.addEventListener('click', () => {
        errorModal.style.display = 'none';
    });

    // Formulaire d'inscription
    document.getElementById('signupForm').addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);
        const response = await fetch('signups.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        if (result.error) {
            showError(result.error);
        } else if (result.success) {
            showSuccess("Inscription réussie !");
        }
    });
});
