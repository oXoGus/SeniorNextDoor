<?php
    // on supprime la demande d'ami pour l'utilisateur
    $res = $cnx->exec("DELETE FROM ami WHERE id_ami = $id AND id_utilisateur = $id_ami");
?>