document.getElementById('submit-button').addEventListener('click', function(event) {
    var form = document.getElementById('division-form');
    var confirmMessage = "Êtes-vous sûr de vouloir ajouter cette division ?";
    if (!confirm(confirmMessage)) {
        event.preventDefault(); // Empêche l'envoi du formulaire si l'utilisateur annule
    }
});
