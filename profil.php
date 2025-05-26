<?php
    include($originDIR.'/config/connexion_db.php');

    // récupération des informations du profil
    $res = $cnx->query("SELECT pseudo, date_naissance, bio, id_ehpad, avatar, avatar_img_type, code_statut, lib_statut FROM utilisateur NATURAL JOIN statut where id = $id");
    $user = $res->fetch(PDO::FETCH_OBJ);

    // on récup le nom de l'éhpade 
    $res = $cnx->query("SELECT nom from ehpad WHERE id_ehpad = $user->id_ehpad");

    $ehpad = $res->fetch(PDO::FETCH_OBJ);

    // on encode l'image dans un lien
    include($originDIR."/app/models/formatUserAvatar.php");
    
?>