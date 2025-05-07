<?php
    // connexion a la db
    include($originDIR."/config/connexion_db.php"); 

    
    $res = $cnx->query("SELECT * from bloquer where id_utilisateur = $id and id_utilisateur_bloque = $id_autre_utilisateur");
    
    // si l'utilisateur était déja bloqué 
    if ($res->rowCount() == 1){
        
        // on le débloque
        $res = $cnx->exec("DELETE FROM bloquer WHERE id_utilisateur = $id and id_utilisateur_bloque = $id_autre_utilisateur");

        // on redirige l'utilisateur sur la page de l'annuaire
        // avec le pseudo cherché pour garder la recherche 
        $pseudoSearched = $_GET['searchInput'];
        header("location: /SeniorNextDoor/annuaire.php?searchInput=$pseudoSearched");
        
        exit;
    }
    
    // sinon on bloque l'utilisateur 
    $res = $cnx->exec("INSERT INTO bloquer (id_utilisateur, id_utilisateur_bloque) VALUES ($id, $id_autre_utilisateur)");

    // on supprime l'ami 
    $res = $cnx->query("SELECT * from ami where id_utilisateur = $id and id_ami = $id_autre_utilisateur");
    
    // si on était ami avec 
    if ($res->rowCount() == 1){
        
        // on supprime l'ami 
        $res = $cnx->exec("DELETE FROM ami WHERE id_utilisateur = $id AND id_ami = $id_autre_utilisateur");   
    }

    // on redirige l'utilisateur sur la page de l'annuaire
    // avec le pseudo cherché pour garder la recherche 
    $pseudoSearched = $_GET['searchInput'];
    header("location: /SeniorNextDoor/annuaire.php?searchInput=$pseudoSearched");
?>