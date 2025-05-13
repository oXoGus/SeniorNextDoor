<?php
    include($originDIR."/config/middleware.php"); // page uniquement accessible aux utilisateurs 

    if (isset($_GET['id']) && !empty($_GET['id'])){

        $id_ami = $_GET['id'];
        
        // on ajoute ou retire l'ami selon si on était déja ami avec
        include($originDIR."/app/models/addFriend.php");

        // on redirige l'utilisateur sur la page de l'annuaire
        // avec le pseudo cherché pour garder la recherche 
        $pseudoSearched = $_GET['searchInput'];
        header("location: /SeniorNextDoor/annuaire.php?searchInput=$pseudoSearched");
    }
?>