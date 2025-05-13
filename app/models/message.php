<?php
include($originDIR . '/config/connexion_db.php');
// récupération de l'id pour l'afficher sur la page id 

// liste de tout les utilisateurs qui sont en ami avec l'utilisateur et réciproquement
$recupUser = $cnx->query("SELECT uAmi.*, lib_statut, (SELECT nom FROM ehpad WHERE id_ehpad = uAmi.id_ehpad LIMIT 1) loc FROM ami JOIN utilisateur uAmi ON ami.id_ami = uAmi.id NATURAL JOIN statut where id_utilisateur = $id AND EXISTS (SELECT * FROM ami WHERE id_utilisateur = uAmi.id AND id_ami = $id) ORDER BY (SELECT date_message FROM message WHERE (id_emeteur = uAmi.id AND id_destinataire = $id) OR (id_emeteur = $id AND id_destinataire = uAmi.id) ORDER BY date_message DESC LIMIT 1) DESC");

$user = $cnx->query("SELECT pseudo, avatar_img_type, avatar FROM utilisateur WHERE id = $id")
?>