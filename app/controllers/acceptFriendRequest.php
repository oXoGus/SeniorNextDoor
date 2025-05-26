<?php
    include($originDIR."/config/middleware.php"); // page uniquement accessible aux utilisateurs 

    if (isset($_GET['id_ami']) && !empty($_GET['id_ami'])){

        $id_ami = $_GET['id_ami'];
        
        // on ajoute ou retire l'ami selon si on était déja ami avec
        include($originDIR."/app/models/addFriend.php");

        // on redirige l'utilisateur sur la page de l'annuaire
        // avec le pseudo cherché pour garder la recherche 
        header("location: message.php?idAmi=$id_ami");
    }
?>