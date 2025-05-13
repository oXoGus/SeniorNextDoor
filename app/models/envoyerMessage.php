<?php
    if (isset($messageEnvoyer)) {
        $insertion_msg = $cnx->exec("INSERT INTO message(id_emeteur,id_destinataire,contenu_message,date_message,vue) VALUES($id, $idAmi, " . $cnx->quote($messageEnvoyer) . ",current_timestamp,0)");
    }
?>