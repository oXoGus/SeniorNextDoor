<?php
    include($originDIR."/config/middleware.php"); // page uniquement accessible aux utilisateurs 

    if (isset($_GET['id']) && !empty($_GET['id'])){

        $id_autre_utilisateur = $_GET['id'];
        
        // on ajoute ou retire l'ami selon si on était déja ami avec
        include($originDIR."/app/models/blockUser.php");
    }
?>