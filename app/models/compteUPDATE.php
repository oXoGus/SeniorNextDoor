<?php
    // connexion a la db
    include($originDIR.'/config/connexion_db.php');

    // mise a jour des données
    if (isset($pseudo)){

        // le pseudo est unique donc on a une erreur si si l'utilisateur rentre un pseudo déja pris
        try {
            $cnx->query("UPDATE utilisateur SET pseudo = ".$cnx->quote($pseudo)." WHERE id = $id");
            $cnx->query("UPDATE compte SET login = ".$cnx->quote($pseudo)." WHERE id = $id");
        } catch (PDOException $e){
            $err = "ce nom d'utilisateur est déja pris";
        }
    }

    if (isset($bio)){
        $cnx->query("UPDATE utilisateur SET bio = ".$cnx->quote($bio)." WHERE id = $id");
    }

    if (isset($imgData)){
        $query = $cnx->prepare("UPDATE utilisateur SET avatar = :img , avatar_img_type = :img_type WHERE id = $id");
        $query->bindParam(":img", $imgData, PDO::PARAM_LOB); // param-lob pour que on envoye les données en binaire pas en texte
        $query->bindParam(":img_type", $imgType, PDO::PARAM_STR);
        $query->execute();
    }

    if (isset($code_statut)){
        $query = $cnx->query("UPDATE utilisateur SET code_statut = ".$cnx->quote($code_statut)." WHERE id = $id");
    }

?>