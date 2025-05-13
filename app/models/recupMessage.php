<?php
    // on charge les message avec l'idAmi
    $recuperation_msg = $cnx->query("SELECT * FROM message WHERE (id_emeteur = $idAmi AND id_destinataire = $id) OR (id_emeteur = $id AND id_destinataire = $idAmi) ORDER BY date_message ASC");

    // on met les messages que nous à envoyé l'ami en vue
    $vue_msg = $cnx->exec("UPDATE message SET vue = 1 WHERE (id_emeteur = $idAmi AND id_destinataire = $id) AND vue <> 1");
?>