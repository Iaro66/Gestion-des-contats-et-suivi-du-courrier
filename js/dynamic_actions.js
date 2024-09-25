document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".crud-form");
    const ajouterButton = form.querySelector(".ajouter");

    ajouterButton.addEventListener("click", function (event) {
        event.preventDefault(); 

        // Récupère les valeurs des champs de formulaire
        const matricule = document.getElementById("matriculeagent").value;
        const nom = document.getElementById("nomagent").value;
        const prenom = document.getElementById("prenomagent").value;
        const tel = document.getElementById("telagent").value;
        const mail = document.getElementById("mailagent").value;
        const porte = document.getElementById("portebatiment").value;
        const service = document.getElementById("nomservice").value;
        const division = document.getElementById("nomdivision").value;
        const  nom_ministere= document.getElementById("nom_ministere").value;

        // Affiche un message de confirmation avec les détails saisis
        const confirmationMessage = `
            Vous êtes sur le point d'ajouter un nouvel agent avec les détails suivants:
            Veuillez bien vérifier avant de confirmer s'il vous plait:
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
            // Si l'utilisateur confirme, soumet le formulaire
            form.submit();
        }
    });
});
