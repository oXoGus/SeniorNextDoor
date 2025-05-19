<?php
session_start();
$originDIR = __DIR__ . '/../..';
include($originDIR."/config/connexion_db.php"); 

$id = $_SESSION['id'];

$idAmi = $_SESSION['idAmi'];

// on récup l'avatar et le pseudo de l'utilisateur et de l'ami
$userInfo = $cnx->query("SELECT pseudo, avatar_img_type, avatar FROM utilisateur WHERE id = $id");
$user = $userInfo->fetch(PDO::FETCH_OBJ);

// fomatage de l'avatar
include($originDIR."/app/models/formatUserAvatar.php");

$userInfo = $user;

$friendInfo = $cnx->query("SELECT pseudo, avatar_img_type, avatar FROM utilisateur WHERE id = $idAmi");
$user = $friendInfo->fetch(PDO::FETCH_OBJ);

// fomatage de l'avatar
include($originDIR."/app/models/formatUserAvatar.php");

$friendInfo = $user;

// récupération des messages
include($originDIR."/app/models/recupMessage.php");

while ($message = $recuperation_msg->fetch(PDO::FETCH_OBJ)) {
    $vue="";
    if ($message->vue === 0){
        $vue="pas encore vue";
    }
    if ($message->id_emeteur == $id) {
        echo '<div class="msgMoi">
        <div class="Imgprofil"><h1>Vous</h1><img src="'.$userInfo->avatar.'" /></div>
        <p><b>' . $message->contenu_message . '</b>';
        echo '</br> <i class="info">'.$vue." ". $message->date_message. ' </i> </p> </div>';
    } else {
        echo '<div class="msgAmi">
        <div class="ImgprofilAmi"><img src="'.$friendInfo->avatar.'" /><h1>'.$friendInfo->pseudo.'</h1></div>
        <p><b>' . $message->contenu_message . '</b>';
        echo '</br> <i class="info"> '. $message->date_message. '</i> </p> </div>';
    }
}
?>