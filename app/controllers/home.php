<?php
    // page accessible uniquement au utilisateurs
    include($originDIR.'/config/middleware.php'); // path relatif au public/home.php

    // on récup les info pour l'affichage
    include($originDIR.'/app/models/home.php');

    $userInfo = $user;

    $friendRequestList = array();

    while ($user = $friendRequestQuery->fetch(PDO::FETCH_OBJ)){
        
        // on récup l'avatar de l'utilisateur 
        include($originDIR."/app/models/formatUserAvatar.php");
        
        $friendRequestList[$user->id] = $user;
    }

    $user = $userInfo;

    // pour ouvrir direct les notif au chargement de la pag
    $openNotifDirectly = isset($_GET['openNotif']) && $_GET['openNotif'] === "1";

    // on fait l'affichage dynamique pour l'utilisateur
    include($originDIR.'/app/views/home.php');
?>