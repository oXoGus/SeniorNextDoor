<?php
    // page accessible uniquement au utilisateurs
    include($originDIR.'/config/middleware.php'); // path relatif au public/home.php
    
    // on fait l'affichage dynamique pour l'utilisateur
    include($originDIR.'/app/views/calendrier_global.php');
?>