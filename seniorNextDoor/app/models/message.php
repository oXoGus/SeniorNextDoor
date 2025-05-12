<?php
include($originDIR . '/config/connexion_db.php');
// récupération de l'id pour l'afficher sur la page id 

$id = $_SESSION['id'];
$recupUser = $cnx->query("SELECT * FROM utilisateur where id != $id"); //recuperation des utilisateurs
$j = 0;
while ($user = $recupUser->fetch()) {
    $listeAmi[$j] = $user;
    $j = $j + 1;
}

$res = $cnx->query("SELECT * FROM utilisateur where id=" . $idAmi);
$nom = $res->fetch(PDO::FETCH_OBJ)->pseudo;

$vue_msg = $cnx->prepare('UPDATE message SET vue=1 WHERE (id_emeteur = ? AND id_destinataire = ?) AND vue<>1');
$vue_msg->execute(array($idAmi, $id));

$recuperation_msg = $cnx->prepare('SELECT * FROM message WHERE (id_emeteur = ? AND id_destinataire = ?) OR (id_emeteur = ? AND id_destinataire = ?)');
$recuperation_msg->execute(array($id, $idAmi, $idAmi, $id));
$j = 0;
while ($message = $recuperation_msg->fetch()) {
    $listeMsg[$j] = $message;
    $j = $j + 1;
}


if (isset($messageEnvoyer)) {
    $insertion_msg = $cnx->query("INSERT INTO message(id_emeteur,id_destinataire,contenu_message,date_message,vue) VALUES($id, $idAmi, " . $cnx->quote($messageEnvoyer) . ",current_timestamp,0)");// preparation de notre requete
}
/*$idAmi = $user['id'];
    $pseudo = $user['pseudo'];
    $lib_statut = $user['code_statut'];
    $couleur = "jaune";
    $statut = "";
    if ($lib_statut == "ENL") {
        $couleur = "vert";
        $statut = "en ligne";
    }
    if ($lib_statut == "HOL") {
        $couleur = "rouge";
    } */
?>