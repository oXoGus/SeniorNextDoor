<?php
    include($originDIR.'/config/connexion_db.php');

    // récupération  du pseudo pour l'afficher sur la page home
    $res = $cnx->query("SELECT pseudo, avatar, avatar_img_type FROM utilisateur where id = $id");
    $user = $res->fetch(PDO::FETCH_OBJ);

    // récupération de toutes les demandes d'ami en attantes 
    $friendRequestQuery = $cnx->query("SELECT uAmi.id, uAmi.pseudo, uAmi.avatar_img_type, uAmi.avatar FROM ami JOIN utilisateur uAmi ON ami.id_utilisateur = uAmi.id where id_ami = $id AND id_utilisateur = uAmi.id AND NOT EXISTS (SELECT * FROM ami WHERE id_utilisateur = $id AND id_ami = uAmi.id)");

    // on récup l'avatar de l'utilisateur 
    include($originDIR."/app/models/formatUserAvatar.php");
?>