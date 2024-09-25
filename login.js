function showError(message) {
    const popup = document.getElementById('errorPopup');
    const messageElement = document.getElementById('errorMessage');
    messageElement.textContent = message;
    popup.style.display = 'block';
}

function closePopup() {
    document.getElementById('errorPopup').style.display = 'none';
}

document.getElementById('loginForm').addEventListener('submit', function(event) {
    const nomUtilisateur = document.getElementById('nomutilisateur').value.trim();
    const motDePasse = document.getElementById('motdepasse').value.trim();

    if (nomUtilisateur === '' || motDePasse === '') {
        showError('Veuillez remplir tous les champs.');
        event.preventDefault(); // Empêche l'envoi du formulaire
    }
});
