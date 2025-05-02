<?php

    include($originDIR."/config/connexion_db.php");
    
    // requete de verification
    // recuperation du hash
    $res = $cnx->query("SELECT * FROM compte where login = ".$cnx->quote($login)." and mdp = md5(".$cnx->quote($mdp).")");
    
    // on renvoie le res au controleur
    $res->fetch(PDO::FETCH_OBJ); // true si un user a été trouvé 
?>