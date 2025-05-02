<?php
    // page accessible uniquement au utilisateurs
    include('../config/middleware.php'); // path relatif au public/home.php


    // on récup les info pour l'affichage
    include('../app/models/home.php');

    // on fait l'affichage dynamique pour l'utilisateur
    include('../app/views/home.php');
?>