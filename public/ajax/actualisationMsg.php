<?php
session_start();
$originDIR = realpath(__DIR__ . '/../../');
include($originDIR."/config/connexion_db.php"); // adapte ce chemin selon ta structure

$id = $_SESSION['id'];
if (!isset($_GET['idAmi'])) { //initialisation qui correspond a la personne qu'on veut afficher en premier quand on lance le chat
    $idAmi = 1;
} else {
    $idAmi = $_GET['idAmi'];
}
$recuperation_msg = $cnx->prepare('SELECT * FROM message WHERE (id_emeteur = ? AND id_destinataire = ?) OR (id_emeteur = ? AND id_destinataire = ?)');
$recuperation_msg->execute([$id, $idAmi, $idAmi, $id]);

while ($message = $recuperation_msg->fetch()) {
        $vue="";
        if ($message['vue']==0){
            $vue="pas encore vue";
        }
    if ($message['id_emeteur'] == $id) {
        echo '<div class="msgMoi">
                <div class="Imgprofil"><img src="img/Chantalle.jpg" /></div>
                <p>' . $message['contenu_message']. '';
                echo '</br> <i class="info">'.$vue." ". $message["date_message"]. ' </i> </p> </div>';
    } else {
        echo '<div class="msgAmi">
                <div class="Imgprofil"><img src="img/Chantalle.jpg" /></div>
                <p>' . $message['contenu_message']. '';
                echo '</br> <i class="info"> '. $message["date_message"]. '</i> </p> </div>';
    }
}
?>