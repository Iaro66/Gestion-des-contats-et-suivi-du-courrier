<div id="popup-container" class="popup-hidden">
    <div id="popup-message" class="popup-content"></div>
    <button id="popup-close">Fermer</button>
</div>

<div id="agentModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Sélectionner l'agent traitant</h3>
        <form id="agentForm">
            <label for="agent-traitant">Agent traitant :</label>
            <select id="agent-traitant" name="agent_traitant" required>
                <option value="" disabled selected>Sélectionner l'agent</option>
                <?php
                $result = $conn->query("SELECT idagent101, nomagent101 FROM agent101");
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['idagent101'] == $_SESSION['user_id']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($row['idagent101'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($row['nomagent101'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
                ?>
            </select>
            <button type="button" id="confirmAgentBtn">Confirmer</button>
        </form>
    </div>
</div>

<!-- Popup Formulaire de Transfert -->
<div id="transfer-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <h2>Transfert de Courrier</h2>
        <form id="transfer-form">
            <input type="hidden" id="courrier-id" name="courrier_id">
            <label for="date-transfert">Date de transfert :</label>
            <input type="date" id="date-transfert" name="date_transfert" required>

            <label for="agent-expediteur">Agent expéditeur :</label>
            <select id="agent-expediteur" name="agent_expediteur" required>
            <option value="" disabled selected>Sélectionner l'agent</option>
                <?php
                $result = $conn->query("SELECT idagent101, nomagent101 FROM agent101");
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['idagent101'] == $_SESSION['user_id']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($row['idagent101'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($row['nomagent101'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
                ?>
            </select>

            <label for="agent-destinataire">Agent destinataire :</label>
            <select id="agent-destinataire" name="agent_destinataire" required>
            <option value="" disabled selected>Sélectionner l'agent</option>
                <?php
                $result = $conn->query("SELECT idagent101, nomagent101 FROM agent101");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['idagent101'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['nomagent101'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
                ?>
            </select>

            <button type="submit">Transférer</button>
        </form>
    </div>
</div>
<!-- Confirmation Popup -->
<div id="confirmation-popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <h2>Confirmation</h2>
        <p>Êtes-vous sûr de vouloir transférer ce courrier ?</p>
        <button id="confirm-btn">Oui</button>
        <button id="cancel-btn">Non</button>
    </div>
</div>


<div id="edit-popup" class="popup-hidden">
    <div class="popup-content">
        <h3>Modifier le courrier</h3>
        <form id="edit-form">
            <input type="hidden" id="edit-id" name="id">
            <label for="edit-date-courrier">Date du courrier :</label>
            <input type="date" id="edit-date-courrier" name="date_courrier">

            <label for="edit-num">Numéro :</label>
            <input type="number" id="edit-num" name="num">

            <label for="edit-ref">Référence :</label>
            <input type="text" id="edit-ref" name="ref">

            <label for="edit-description">Description :</label>
            <input type="text" id="edit-description" name="description">

            <label for="edit-remarque">Remarque :</label>
            <input type="text" id="edit-remarque" name="remarque">

            <button type="submit">Enregistrer</button>
            <button type="button" id="edit-close">Annuler</button>
        </form>
    </div>
</div>
<!-- Popup Classer HTML -->
<div id="classer-popup" class="popup-hidden">
    <div class="popup-content">
        <h3>Classer le courrier</h3>
        <form id="classer-form">
            <input type="hidden" id="classer-id" name="id">
            <label for="date_classement">Date de classement :</label>
            <input type="date" id="date_classement" name="date_classement" required>
            <button type="submit">Classer</button>
            <button type="button" id="classer-close">Annuler</button>
        </form>
    </div>
</div>

    <!-- Popup Formulaire d'archivage -->
<div id="archiver-popup" class="popup-hidden">
    <div class="popup-content">
        <h3>Archiver le courrier</h3>
        <form id="archiver-form">
            <input type="hidden" id="archiver-id" name="id">
            <label for="date-archivage">Date d'archivage :</label>
            <input type="date" id="date-archivage" name="date_archivage" required>

            <label for="lieu-archivage">Lieu d'archivage :</label>
            <input type="text" id="lieu-archivage" name="lieu_archivage" required>

            <button type="submit">Archiver</button>
            <button type="button" id="archiver-close">Annuler</button>
        </form>
    </div>
</div>