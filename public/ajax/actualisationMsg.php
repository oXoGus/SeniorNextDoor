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

    // mise en forme du timestamps du message
    
    $maintenant = new DateTime('now', new DateTimeZone('Europe/Paris'));
    
    // on récup et convertit le timestamp de la db en timestamps php
    $dateMessage = DateTime::createFromFormat('Y-m-d H:i:s.u', $message->date_message, new DateTimeZone('Europe/Paris'));
    
    // différence des timestamps pour voir le temps écoulé depuis l'envoie du message
    $tempsEcoule = $maintenant->diff($dateMessage);
    

    // mise en forme 
    $message->tempsEcoule = "il y a ";

    if ($tempsEcoule->d > 0) {
        $message->tempsEcoule = $message->tempsEcoule . $tempsEcoule->d . ' jour' . ($tempsEcoule->d > 1 ? 's' : '');
    }

    if ($tempsEcoule->h > 0) {
        $message->tempsEcoule = $message->tempsEcoule . ($tempsEcoule->d > 0 ? " et " : "") . $tempsEcoule->h . ' heure' . ($tempsEcoule->h > 1 ? 's' : '');
    }

    if ($tempsEcoule->i >= 0) {
        $message->tempsEcoule = $message->tempsEcoule . ($tempsEcoule->h  > 0 ? " et " : "") . $tempsEcoule->i . ' minute' . ($tempsEcoule->i > 1 ? 's' : '');
    }

    $vue="";
    if ($message->vue === 0){
        $vue="pas encore vue";
    }
    if ($message->id_emeteur == $id) {
        echo '<div class="msgMoi">
        <div class="Imgprofil"><h1>Vous</h1><img src="'.$userInfo->avatar.'" /></div>
        <p><b>' . $message->contenu_message . '</b>';
        echo '</br> <i class="info">'. $message->tempsEcoule. '</i> </p> </div>';
    } else {
        echo '<div class="msgAmi">
        <div class="ImgprofilAmi"><img src="'.$friendInfo->avatar.'" /><h1>'.$friendInfo->pseudo.'</h1></div>
        <p><b>' . $message->contenu_message . '</b>';
        echo '</br> <i class="info"> '. $message->tempsEcoule.'</i> </p> </div>';
    }
}
?>