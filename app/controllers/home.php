<?php
    // page accessible uniquement au utilisateurs
    include($originDIR.'/config/middleware.php'); // path relatif au public/home.php

    // on récup les info pour l'affichage
    include($originDIR.'/app/models/home.php');

    if (!$val){
        header('location: /SeniorNextDoor/connexion.php');
    }

    // on fait l'affichage dynamique pour l'utilisateur
    include($originDIR.'/app/views/home.php');
?>