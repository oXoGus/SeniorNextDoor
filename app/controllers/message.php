<?php
// page accessible uniquement au utilisateurs
include($originDIR . '/config/middleware.php'); // path relatif au public/home.php

// on récup les info pour l'affichage
include($originDIR . '/app/models/message.php');

$user = $user->fetch(PDO::FETCH_OBJ);

// on met en forme l'avater de l'utilisateur pour l'afficher a coté de ses messages
include($originDIR."/app/models/formatUserAvatar.php");

$userInfo = $user;

$listeAmi = array();

while ($user = $recupUser->fetch(PDO::FETCH_OBJ)) {
    
    // on récup l'avatar de l'utilisateur 
    include($originDIR."/app/models/formatUserAvatar.php");
    
    // mis en forme des donnée pour l'affichage du profil dans la partie gauche

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

        
        
        // si la date d'anniversaire n'est pas encore passé
        if ($currMois < $mois){
            $annee--;
        }else if ($currMois == $mois){
            
            // avec les jours
            if ($currJour < $jour){
                $annee--;
            }
        }

        $user->age = $currAnnee - $annee. "ans";
    }
    else {
        $user->age =  "aucune données trouvé";
    }

    if (empty($user->bio)){
        $user->bio = "aucune bio";
    }

    $listeAmi[$user->id] = $user;
}
$idAmi;

// les info de l'ami qui est séléctionné
if (!isset($_GET['idAmi'])) { //initialisation qui correspond a la personne qu'on veut afficher en premier quand on lance le chat
    
    // on prend le message la conversation avec le message le plus recent 
    foreach ($listeAmi as $user){
        $idAmi = $user->id;
        break;
    }
} else {
    
    $idAmi = $_GET['idAmi'];
}

// les info de l'ami qui est séléctionné
$nom = $listeAmi[$idAmi]->pseudo;


if (isset($_POST['envoyer'])) {

    $messageEnvoyer = htmlspecialchars($_POST['message']);
    include($originDIR."/app/models/envoyerMessage.php");
}

// récupération des messages
include($originDIR."/app/models/recupMessage.php");

while ($message = $recuperation_msg->fetch(PDO::FETCH_OBJ)) {
    $listeMsg[] = $message;
}

// on fait l'affichage dynamique pour l'utilisateur
include($originDIR . '/app/views/message.php');
?>