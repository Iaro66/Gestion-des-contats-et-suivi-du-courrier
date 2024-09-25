document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("transfer-popup");
    const confirmationPopup = document.getElementById("confirmation-popup");
    const transferBtns = document.querySelectorAll(".transferer-btn");
    const closeBtn = document.querySelector(".close-btn");
    const confirmBtn = document.getElementById("confirm-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    const transferForm = document.getElementById("transfer-form");
    const courrierIdInput = document.getElementById("courrier-id");
    
    let pendingFormData = null; 

    // Afficher le popup au clic sur le bouton "Transférer"
    transferBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            const courrierId = this.getAttribute("data-id");
            courrierIdInput.value = courrierId; // Remplit le champ caché avec l'ID du courrier
            popup.style.display = "block";
        });
    });

    // Fermer le popup
    closeBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });

    // Afficher la boîte de dialogue de confirmation
    transferForm.addEventListener("submit", function (e) {
        e.preventDefault();
        pendingFormData = new FormData(transferForm); // Stockage des données du formulaire en attente
        popup.style.display = "none"; // Fermer le popup de transfert
        confirmationPopup.style.display = "block"; // Afficher la boîte de dialogue de confirmation
    });

    // Confirmer le transfert
    confirmBtn.addEventListener("click", function () {
        fetch("transfer_courrier.php", {
            method: "POST",
            body: pendingFormData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Ajout des nouvelles valeurs dans le tableau des transferts
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${data.date_transfert}</td>
                    <td>${data.numero}</td>
                    <td>${data.date_courrier}</td>
                    <td>${data.ref}</td>
                    <td>${data.description}</td>
                    <td>${data.statut}</td>
                    <td>${data.agent_expediteur}</td>
                    <td>${data.agent_destinataire}</td>
                    <td>
                        <button class='classer-btn' data-id='${data.idcourrier}'>Classer</button>
                        <button class='archiver-btn' data-id='${data.idcourrier}'>Archiver</button>
                    </td>
                `;
                document.getElementById("transfer-table-body").appendChild(newRow);
                confirmationPopup.style.display = "none"; // Fermer la boîte de dialogue de confirmation
            } else {
                alert("Transfert avec succès !");
                window.location.href = 'index.php';
            }
            
        })
        .catch(error => console.error('Erreur:', error));
    });

    // Annuler le transfert
    cancelBtn.addEventListener("click", function () {
        confirmationPopup.style.display = "none"; // Fermer la boîte de dialogue de confirmation
        popup.style.display = "block"; // Réouvrir le popup de transfert si nécessaire
    });
});
