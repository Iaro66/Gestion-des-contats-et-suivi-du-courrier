<?php
include 'db.php'; 

$query = "SELECT a.idagent, a.portebatiment, a.matriculeagent, a.nomagent, a.prenomagent, s.nomservice, a.nomdivision, a.nom_ministere, a.mailagent, a.telagent
          FROM agent a
          LEFT JOIN services s ON a.nomservice = s.nomservice";

$result = $conn->query($query);

if (!$result) {
    die("Erreur de requête : " . $conn->error);
}

if ($result->num_rows > 0) { 
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['portebatiment']}</td>";
        echo "<td>{$row['matriculeagent']}</td>";
        echo "<td>{$row['nomagent']}</td>";
        echo "<td>{$row['prenomagent']}</td>";
        echo "<td>{$row['nomservice']}</td>";
        echo "<td>{$row['nomdivision']}</td>";
        echo "<td>{$row['nom_ministere']}</td>";
        echo "<td>{$row['mailagent']}</td>";
        echo "<td>{$row['telagent']}</td>";
        if ($is_admin) {
            echo "<td>
                    <a href='agent_edit.php?id=" . $row['idagent'] . "' class='modifier'>Modifier</a>
                    <a href='agent_delete.php?id=" . $row['idagent'] . "' class='supprimer' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce bâtiment ?\");'>Supprimer</a>
                  </td>";
        }

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>Aucun agent trouvé</td></tr>";
}


$conn->close();
?>
