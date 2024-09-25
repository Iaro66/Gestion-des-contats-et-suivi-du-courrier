document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".crud-form");
    const modifierButton = form.querySelector("input[type='submit']"); 

    modifierButton.addEventListener("click", function (event) {
        event.preventDefault(); 

        // Récupérer les valeurs des champs de formulaire
        const matricule = document.getElementById("matriculeagent").value;
        const nom = document.getElementById("nomagent").value;
        const prenom = document.getElementById("prenomagent").value;
        const tel = document.getElementById("telagent").value;
        const mail = document.getElementById("mailagent").value;
        const porte = document.getElementById("portebatiment").value;
        const service = document.getElementById("nomservice").value;
        const division = document.getElementById("nomdivision").value;
        const nom_ministere = document.getElementById("nom_ministere").value;

        // Afficher un message de confirmation avec les détails saisis
        const confirmationMessage = `
            Vous êtes sur le point de modifier un nouvel agent avec les détails suivants:
            Veuillez bien vérifier avant de confirmer s'il vous plaît:
            - Matricule : ${matricule}
            - Nom : ${nom}
            - Prénom : ${prenom}
            - Téléphone : ${tel}
            - Email : ${mail}
            - Porte Bâtiment : ${porte}
            - Service : ${service}
            - Division : ${division}
            - Responsable Ministère : ${nom_ministere}

            Voulez-vous continuer ?
        `;

        if (confirm(confirmationMessage)) {
            form.submit();
        }
    });
});
