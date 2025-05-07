<?php
    include($originDIR.'/config/connexion_db.php');

    // récupération  du pseudo pour l'afficher sur la page home
    $res = $cnx->query("SELECT pseudo, avatar, avatar_img_type FROM utilisateur where id = $id");
    $user = $res->fetch(PDO::FETCH_OBJ);

    // on récup l'avatar de l'utilisateur 
    include($originDIR."/app/models/formatUserAvatar.php");
?>