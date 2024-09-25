document.addEventListener("DOMContentLoaded", function () { 
    const modal = document.getElementById("agentModal");
    const confirmBtn = document.getElementById("confirmAgentBtn");
    const closeBtn = document.querySelector(".close");
    const traiterBtns = document.querySelectorAll(".traiter-btn");
    let selectedCourrierId = null; 

    // Affiche modale au clic sur bouton "Traiter"
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("traiter-btn")) {
            selectedCourrierId = event.target.getAttribute("data-id");

            // Afficher une boîte de dialogue de confirmation
            if (confirm("Êtes-vous sûr de vouloir traiter ce courrier ?")) {
                modal.style.display = "block";
            }
        }
    });

    // Fermer la modale
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Fermer la modale en cliquant en dehors
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Confirmer traitement du courrier
    confirmBtn.addEventListener("click", function () {
        const selectedAgentOption = document.querySelector("#agent-traitant option:checked");
        const selectedAgent = selectedAgentOption ? selectedAgentOption.value : null;

        // Vérifier que l'agent est sélectionné
        if (!selectedAgent) {
            alert("Veuillez sélectionner un agent.");
            return;
        }

        // Envoyer la requête au serveur
        fetch("traiter_courrier.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "id=" + encodeURIComponent(selectedCourrierId) + "&agent=" + encodeURIComponent(selectedAgent)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Log pour vérifier la réponse de la requête
            if (data.success) {
                // Courrier traité avec succès, actualiser la page
                alert("Courrier traité avec succès !");
                window.location.reload(); // Actualise la page
            } else {
                alert(data.error || "Erreur lors du traitement du courrier.");
            }
        })
        .catch(error => console.error("Erreur:", error));
    });
});
