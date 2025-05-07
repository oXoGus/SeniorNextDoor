<?php

    // page accessible uniquement au utilisateurs 
    include($originDIR.'/config/middleware.php');

    // si l'utilisateur vien de modifier le form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['pseudo']) || isset($_FILES['avatar']) || isset($_POST['bio']))){
        
        // pas de pseudo vide
        if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
            $pseudo = $_POST['pseudo'];
        }

        // le transfer de fichier marche qu'avec la méthode post
        if (!empty($_FILES['avatar']['tmp_name'])){
            $imgData = file_get_contents($_FILES['avatar']['tmp_name']);
            $imgType = $_FILES['avatar']['type'];
        } 

        if (isset($_POST['bio'])){
            $bio = $_POST['bio'];
        }

        if (isset($_POST['code_statut'])){
            $code_statut = $_POST['code_statut'];
        }

        // on met a jour les données 
        include($originDIR.'/app/models/compteUPDATE.php');

        // si il n'y pas eu d'erreurs 
        if (!isset($err)){
            $message = "les informations ont bien été enregistré";
        }
    }


    // on affiche juste le form

    // récupérations des info de la db 
    include($originDIR.'/app/models/compteGET.php');

    // affichage dynamique
    include($originDIR.'/app/views/compte.php');
    
?>