<?php
    // connexion a la db
    include($originDIR.'/config/connexion_db.php');


    // on récup juste les info existante dans la table utilsateur 
    $res = $cnx->query("SELECT pseudo, bio, code_statut, avatar, avatar_img_type FROM utilisateur WHERE id = $id");
    $user = $res->fetch(PDO::FETCH_OBJ);

    // on récup l'avatar de l'utilisateur 
    include($originDIR."/app/models/formatUserAvatar.php");
?>