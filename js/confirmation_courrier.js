function showConfirmation() {
    // Récupère les valeurs des champs du formulaire
    var dateReception = document.getElementById('date_reception').value;
    var agent = document.getElementById('agent').options[document.getElementById('agent').selectedIndex].text;
    var dateCourrier = document.getElementById('date_courrier').value;
    var num = document.getElementById('num').value;
    var ref = document.getElementById('ref').value;
    var description = document.getElementById('description').value;
    var remarque = document.getElementById('remarque').value;

    // Affiche les valeurs dans la modal de confirmation
    var confirmationDetails = `
        <p>Date de réception : ${dateReception}</p>
        <p>Agent Récepteur : ${agent}</p>
        <p>Date du courrier : ${dateCourrier}</p>
        <p>N° : ${num}</p>
        <p>Réf : ${ref}</p>
        <p>Description : ${description}</p>
        <p>Remarque : ${remarque}</p>
    `;
    document.getElementById('confirmation-details').innerHTML = confirmationDetails;

    // Affiche la modal de confirmation
    document.getElementById('confirmation-modal').style.display = 'block';
}

function closeModal() {
    // Ferme la modal
    document.getElementById('confirmation-modal').style.display = 'none';
}

function submitForm() {
    // Soumet le formulaire
    document.getElementById('form-courrier').submit();
}