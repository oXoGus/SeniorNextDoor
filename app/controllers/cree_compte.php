<?php

    // si l'utilisateur vient de remplir tout le form 
    if (!empty($_GET['login']) && !empty($_GET['mdp']) && !empty($_GET['mdpConf'])){

        // recup des info du senior
        $login = $_GET['login'];
        $mdp = $_GET['mdp'];
        $mdpConf = $_GET['mdpConf'];

        if ($mdp != $mdpConf){
            // on crée l'erreur
            $err = "les deux mots de passe ne sont pas identiques";
            include($originDIR.'/app/views/cree_compte.php');
            exit; // pour stoper le code
        }
        
        // on appel le model pour créer un compte
        include($originDIR.'/app/models/cree_compte.php');
        
        // si on a eu une erreur lors des requetes
        if (isset($err)){
            include($originDIR.'/app/views/cree_compte.php');
            exit;
        }

        // le compte a bien été crée 
        // on connecte directement le joueur en mettant ces 
        // credantials dans la session 
        session_start();
        
        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $mdp;

        // on redirect l'utilisateur sur la page home
        header('location: /SeniorNextDoor/home.php');
        exit;
    }
    // si l'utilisateur n'a pas envoyé le form
    else {

        // on affiche le form 
        include($originDIR.'/app/views/cree_compte.php');
    }    
?>