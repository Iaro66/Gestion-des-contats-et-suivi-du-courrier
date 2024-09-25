<div class="form-section">
    <form id="form-courrier" action="traitement_courrier.php" method="post">
        <label for="date_reception">Date de réception :</label>
        <input type="date" id="date_reception" name="date_reception" value="<?php echo date('Y-m-d'); ?>">

        <label for="agent">Agent Récepteur :</label>
        <select id="agent" name="agent" required>
        <option value="" disabled selected>Sélectionner l'agent</option>
            <?php
            $result = $conn->query("SELECT idagent101, nomagent101 FROM agent101");
            while ($row = $result->fetch_assoc()) {
                $selected = ($row['idagent101'] == $_SESSION['user_id']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($row['idagent101'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($row['nomagent101'], ENT_QUOTES, 'UTF-8') . "</option>";
            }
            ?>
        </select>

        <label for="date_courrier">Date du courrier :</label>
        <input type="date" id="date_courrier" name="date_courrier" value="<?php echo date('Y-m-d'); ?>">

        <label for="num">N° :</label>
        <input type="number" id="num" name="num">

        <label for="ref">Ref :</label>
        <input type="text" id="ref" name="ref">

        <label for="description">Description :</label>
        <input type="text" id="description" name="description">

        <label for="remarque">Remarque :</label>
        <input type="text" id="remarque" name="remarque">

        <button type="button" onclick="showConfirmation()">Confirmer</button>
        <button type="submit" style="display:none;">AJOUTER</button>
    </form>
</div>


<div id="confirmation-modal" style="display:none;">
    <div class="modal-content">
        <h2>Confirmation</h2>
        <div id="confirmation-details"></div>
        <button onclick="submitForm()">Confirmer et Ajouter</button>
        <button onclick="closeModal()">Annuler</button>
    </div>
</div>
