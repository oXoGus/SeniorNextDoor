<?php
    // cnx à la bdd
    include('../config/connexion_db.php');

    // on créer d'abord un utilisateur 
    // car l'id du compte est l'id du user
    
    // info par défauts  
    
    try {
        // on fait une transaction comme ça si 
        // le le compte existe déja 
        // le user n'est pas créé
        $cnx->beginTransaction();

        // on doit faire une query si on veut recup l'id
        $res = $cnx->query("INSERT INTO utilisateur (pseudo, code_statut, id_ehpad) VALUES (".$cnx->quote($login).", 'ENL', 1) RETURNING id");
        
        $id = $res->fetch(PDO::FETCH_OBJ)->id;

        $res = $cnx->query("INSERT INTO compte (id, login, mdp) VALUES ($id, ".$cnx->quote($login).", md5(".$cnx->quote($mdp).")) RETURNING mdp");

        $cnx->commit();
    }
    catch (PDOException $e){
        // si duplication de primary key
        $cnx->rollBack();

        // pour la partie vue
        $err = "ce nom d'utilisateur existe déja";
    }

    
?>