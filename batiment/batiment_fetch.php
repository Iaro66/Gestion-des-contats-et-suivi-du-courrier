<?php
include 'db.php';
// Récupérer tous les bâtiments de la base de données, triés par numéro de porte
$sql = "SELECT idbatiment, porte, etage FROM batiment ORDER BY porte ASC";
$result = $conn->query($sql);

if (!$result) {
    echo "Erreur lors de l'exécution de la requête SQL : " . $conn->error;
} else if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['porte'] . "</td>";
        echo "<td>" . $row['etage'] . "</td>";
        echo "<td>
                <a href='batiment_edit.php?id=" . $row['idbatiment'] . "' class='modifier'>Modifier</a>
                <a href='batiment_delete.php?id=" . $row['idbatiment'] . "' class='supprimer' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce bâtiment ?\");'>Supprimer</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Aucun bâtiment trouvé.</td></tr>";
}

$conn->close();
?>
