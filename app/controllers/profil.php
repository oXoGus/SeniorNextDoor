<?php
    // page accessible uniquement au utilisateurs
    include($originDIR.'/config/middleware.php'); // path relatif au public/home.php

    // on récup les info pour l'affichage
    include($originDIR.'/app/models/profil.php');

    $pseudo = $user->pseudo;

    // si pas encore de bio
    if (!isset($user->bio) || empty($user->bio)){
        $bio = "<a href=\"compte.php\">Cliquez ici pour ajouter une description</a>";
    } 
    else {
        $bio = $user->bio;
    }
    

    // si la date de naissance est != de null
    if (isset($user->date_naissance)){
        // calcule de l'age
        $date = explode("-", $user->date_naissance);

        // on converti tout en int
        $annee = (int) $date[0];
        $mois = (int) $date[1];
        $jour = (int) $date[2];

        $currentDate = explode("-", date('Y-m-d'));
        $currAnnee = (int) $currentDate[0];
        $currMois = (int) $currentDate[1];
        $currJour = (int) $currentDate[2];

        $age = "Âge : ".$currAnnee - $annee." ans";
        
        // si la date d'anniversaire n'est pas encore passé
        if ($currMois < $mois){
            $annee--;
        }else if ($currMois == $mois){
            
            // avec les jours
            if ($currJour < $jour){
                $annee--;
            }
        }
    }
    else {
        $age =  "aucune données trouvé";
    }

    $loc = "Vie à : ".$ehpad->nom;
    

    // on fait l'affichage dynamique pour l'utilisateur
    include($originDIR.'/app/views/profil.php');
?>