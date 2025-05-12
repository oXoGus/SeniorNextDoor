<?php
// page accessible uniquement au utilisateurs
include($originDIR . '/config/middleware.php'); // path relatif au public/home.php
if (!isset($_GET['idAmi'])) { //initialisation qui correspond a la personne qu'on veut afficher en premier quand on lance le chat
    $idAmi = 1; // faire requete a la bd pour avoir le récup le id du dernier messzgr envoyé
} else {
    $idAmi = $_GET['idAmi'];
}

if (isset($_POST['envoyer'])) {
    $messageEnvoyer = htmlspecialchars($_POST['message']);
}
// on récup les info pour l'affichage
include($originDIR . '/app/models/message.php');


// on fait l'affichage dynamique pour l'utilisateur
include($originDIR . '/app/views/message.php');
?>