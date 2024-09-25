<div class="table-section" style="max-height: 600px; overflow-y: auto; overflow-x: hidden;">
    <input type="text" class="search-bar" placeholder="Rechercher un courrier">
    <table id="nontraite-table">
        <thead>
            <tr>
                <th>Date de réception</th>
                <th>Date du courrier</th>
                <th>Numéro Courrier</th>
                <th>Référence</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Agent Récepteur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="courrier-table-body">
        <?php
$query = "
    SELECT c.*, a.nomagent101 AS nom_agent_recepteur
    FROM courrier c
    JOIN agent101 a ON c.agent_recepteur = a.idagent101
    WHERE c.statut = 'non traité'
";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($courrier = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($courrier['date_reception'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['date_courrier'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['numero'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['ref'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['description'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['statut'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['nom_agent_recepteur'], ENT_QUOTES, 'UTF-8') . "</td> 
                <td>
                    <button class='traiter-btn' data-id='" . htmlspecialchars($courrier['idcourrier'], ENT_QUOTES, 'UTF-8') . "'>Traiter</button>
                    <button class='edit-btn' data-id='" . htmlspecialchars($courrier['idcourrier'], ENT_QUOTES, 'UTF-8') . "'>Modifier</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>Aucun courrier non traité trouvé.</td></tr>";
}
?>
</tbody>
    </table>
</div>
