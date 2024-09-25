<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_contact";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$sql = "SELECT iddivision, nomdivision FROM division";
$result = $conn->query($sql);

if (!$result) {
    echo "Erreur lors de l'exécution de la requête SQL : " . $conn->error;
} else if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        // echo "<td>" . $row['iddivision'] . "</td>";
        echo "<td>" . $row['nomdivision'] . "</td>";
        echo "<td>
                <a href='division_edit.php?id=" . urlencode($row['iddivision']) . "' class='modifier'>Modifier</a>
                <a href='division_delete.php?id=" . urlencode($row['iddivision']) . "' class='supprimer' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ?\");'>Supprimer</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Aucun service trouvé.</td></tr>";
}
$conn->close();
?>
