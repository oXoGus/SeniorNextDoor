<?php

    include($originDIR."/config/connexion_db.php");
    
    // requete de verification
    // recuperation du hash
    $res = $cnx->query("SELECT * FROM compte where login = ".$cnx->quote($login)." and mdp = md5(".$cnx->quote($mdp).")");
    
    // on renvoie le res au controleur
?>