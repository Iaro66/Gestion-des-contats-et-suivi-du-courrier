<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_contact";
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupère tous les services de la base de données, triés par nom
$sql = "SELECT id_ministere, nom_ministere, code_ministere FROM ministere ORDER BY nom_ministere ASC";
$result = $conn->query($sql);

if (!$result) {
    echo "Erreur lors de l'exécution de la requête SQL : " . $conn->error;
} else if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nom_ministere'] . "</td>";
        echo "<td>" . $row['code_ministere'] . "</td>";
        echo "<td>
                <a href='min_edit.php?id=" . urlencode($row['id_ministere']) . "' class='modifier'>Modifier</a>
                <a href='min_delete.php?id=" . urlencode($row['id_ministere']) . "' class='supprimer' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ?\");'>Supprimer</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Aucun Ministère trouvé.</td></tr>";
}

$conn->close();
?>
