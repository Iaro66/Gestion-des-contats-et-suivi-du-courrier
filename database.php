<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_contact";

// Créer la connexion
$conn = new mysqli($servername, $username, $password);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Créer la base de données si elle n'existe pas
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Base de données '$dbname' créée ou déjà existante.<br>";
} else {
    echo "Erreur lors de la création de la base de données : " . $conn->error . "<br>";
}

// Sélectionner la base de données
$conn->select_db($dbname);

// Créer les tables
$tables = [
    "CREATE TABLE IF NOT EXISTS utilisateur (
        idutilisateur INT(10) AUTO_INCREMENT,
        nomutilisateur VARCHAR(128) NOT NULL UNIQUE,
        motdepasseutilisateur VARCHAR(128) NOT NULL,
        role ENUM('user', 'admin', 'autre') DEFAULT 'user',
        PRIMARY KEY (idutilisateur)
    )",
    "CREATE TABLE IF NOT EXISTS division (
        iddivision INT(10) NOT NULL AUTO_INCREMENT,
        nomdivision VARCHAR(150) NOT NULL UNIQUE,
        PRIMARY KEY (iddivision)
    )",
    "CREATE TABLE IF NOT EXISTS ministere (
        id_ministere INT(10) NOT NULL AUTO_INCREMENT,
        nom_ministere VARCHAR(191) NOT NULL UNIQUE,
        code_ministere VARCHAR(32) NULL UNIQUE,
        PRIMARY KEY (id_ministere)
    )",
    "CREATE TABLE IF NOT EXISTS services (
        idservice INT(10) NOT NULL AUTO_INCREMENT,
        nomservice VARCHAR(191) NOT NULL UNIQUE,
        acronymeservice VARCHAR(32) NULL UNIQUE,
        PRIMARY KEY (idservice)
    )",
    "CREATE TABLE IF NOT EXISTS batiment (
        idbatiment INT(10) NOT NULL AUTO_INCREMENT,
        porte VARCHAR(32) NOT NULL UNIQUE,
        etage VARCHAR(32) NULL,
        PRIMARY KEY (idbatiment)
    )",
    "CREATE TABLE IF NOT EXISTS agent101 (
        idagent101 INT(10) NOT NULL AUTO_INCREMENT,
        porteagent101 VARCHAR(32) NOT NULL,
        matriculeagent101 INT(6) NOT NULL,
        nomagent101 VARCHAR(250) NOT NULL,
        servicesagent101 VARCHAR(250) NOT NULL,
        divisionagent101 VARCHAR(250) NOT NULL,
        fonctionagent101 VARCHAR(250) NOT NULL,
         mailagent101 VARCHAR(150) NOT NULL,
        PRIMARY KEY (idagent101)
    )",
    "CREATE TABLE IF NOT EXISTS agent (
        idagent INT(10) AUTO_INCREMENT NOT NULL,
        portebatiment VARCHAR(32) NOT NULL,
        nomservice VARCHAR(191) NOT NULL,
        matriculeagent VARCHAR(50) NOT NULL UNIQUE,
        nomagent VARCHAR(150) NOT NULL,
        prenomagent VARCHAR(250) NOT NULL,
        telagent VARCHAR(10) NULL,
        nomdivision VARCHAR(150) NOT NULL,
        nom_ministere VARCHAR(191) NOT NULL,
        mailagent VARCHAR(150) NULL,
        PRIMARY KEY (idagent),
        FOREIGN KEY (portebatiment) REFERENCES batiment(porte),
        FOREIGN KEY (nomservice) REFERENCES services(nomservice),
        FOREIGN KEY (nomdivision) REFERENCES division(nomdivision),
        FOREIGN KEY (nom_ministere) REFERENCES ministere(nom_ministere)
    )",
    "CREATE TABLE IF NOT EXISTS courrier (
        idcourrier INT(10) AUTO_INCREMENT PRIMARY KEY,
        numero VARCHAR(50) NULL,
        date_reception DATE NOT NULL,
        date_courrier DATE NULL,
        date_verification DATE NOT NULL,
        date_transfert DATE NOT NULL,
        date_archivage DATE NOT NULL,
        date_classement DATE NOT NULL,
        lieu_archivage VARCHAR(150) NOT NULL,
        ref VARCHAR(100) NULL,
        description TEXT,
        remark TEXT,
        agent_recepteur INT(10) NULL,
        agent_traitant INT(10) NULL,
        agent_expediteur INT(10) NULL,
        agent_destinataire INT(10) NULL,
        statut ENUM('non traité', 'vérifié et en cours de traitement', 'transféré', 'archivé', 'classé') NOT NULL,
        FOREIGN KEY (agent_recepteur) REFERENCES agent101(idagent101),
        FOREIGN KEY (agent_traitant) REFERENCES agent101(idagent101),
        FOREIGN KEY (agent_expediteur) REFERENCES agent101(idagent101),
        FOREIGN KEY (agent_destinataire) REFERENCES agent101(idagent101)
    )"
];

foreach ($tables as $query) {
    if ($conn->query($query) === TRUE) {
        echo "Table créée ou déjà existante.<br>";
    } else {
        echo "Erreur lors de la création de la table : " . $conn->error . "<br>";
    }
}

// Afficher les tables existantes
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Tables dans la base de données '$dbname' :</h2><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['Tables_in_' . $dbname] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Aucune table trouvée dans la base de données '$dbname'.";
}

// Fermer la connexion
$conn->close();
?>
