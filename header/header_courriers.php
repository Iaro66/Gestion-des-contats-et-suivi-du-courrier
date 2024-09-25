<?php
require_once '../db.php';
include '../admin/admin.php';
?>
<header class="main-header">
        <div class="header-content">
            <!-- Logo -->
            <div class="logo">
                <img src="../img/I.png" alt="Logo de l'application">
            </div>
            <h2>Suivi des courriers</h2>
            <nav class="main-nav">
                <ul>
                    <li><a href="../agent/index.php">Agent</a></li>
                    <li><a href="../courriers/index.php">Courriers</a></li>
                    <li style="<?php echo $is_admin ? '' : 'display: none;'; ?>"><a href="../batiment/index.php">Bâtiments</a></li>
                    <li style="<?php echo $is_admin ? '' : 'display: none;'; ?>"><a href="../ministere/index.php">Ministères</a></li>
                    <li style="<?php echo $is_admin ? '' : 'display: none;'; ?>"><a href="../service/index.php">Services</a></li>
                    <li style="<?php echo $is_admin ? '' : 'display: none;'; ?>"><a href="../division/index.php">Divisions</a></li>
                    <li><a href="../logout.php">Déconnexion</a></li>
                </ul>
            </nav>
        </div>
    </header>