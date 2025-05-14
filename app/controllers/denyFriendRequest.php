<?php
    include($originDIR."/config/middleware.php"); // page uniquement accessible aux utilisateurs 

    if (isset($_GET['id_ami']) && !empty($_GET['id_ami'])){

        $id_ami = $_GET['id_ami'];
        
        // on ajoute ou retire l'ami selon si on était déja ami avec
        include($originDIR."/app/models/denyFriendRequest.php");

        // on redirige l'utilisateur sur la page home 
        // avec le menu des notification ouvert 
        header("location: /SeniorNextDoor/home.php?openNotif=1");
    }
?>