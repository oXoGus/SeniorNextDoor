<?php
    // connexion a la db
    include($originDIR."/config/connexion_db.php"); 

    // on ajoute ou retire l'ami selon si on était déja ami avec
    $res = $cnx->query("SELECT * from ami where id_utilisateur = $id and id_ami = $id_ami");
    
    // si on est deja ami avec 
    if ($res->rowCount() == 1){
        
        // on supprime l'ami 
        $res = $cnx->exec("DELETE FROM ami WHERE id_utilisateur = $id AND id_ami = $id_ami");
        
    } else {
        $res = $cnx->exec("INSERT INTO ami (id_utilisateur, id_ami, date_ajout) VALUES ($id, $id_ami, current_timestamp)");
    }
    
    
?>