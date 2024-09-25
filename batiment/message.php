<!-- Affichage des messages de confirmation ou d'erreur -->
<?php if (isset($_SESSION['message'])): ?>
    <div class="<?php echo $_SESSION['message_type']; ?>">
        <button class="close-btn" onclick="this.parentElement.style.display='none';">×</button>
        <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
        unset($_SESSION['message_type']); 
        ?>
    </div>
<?php endif; ?>
