<?php
    include($originDIR.'/config/connexion_db.php');

    // récupération du logo et du pseudo pour l'afficher sur la page home
    $res = $cnx->query("SELECT pseudo FROM utilisateur where id = $id");
    $val = $res->fetch(PDO::FETCH_OBJ);
?>