<?php

    // si l'utilisateur vient de remplir tout le form 
    if (!empty($_GET['login']) && !empty($_GET['mdp'])){

        // recup des info du senior
        $login = $_GET['login'];
        $mdp = $_GET['mdp'];
        
        // on appel le model pour créer un compte
        include($originDIR.'/app/models/connexion.php');
        
        // si il n'y a aucun utilisateur avec ce login et mdp
        if (!$res){
            $err = "mauvais mot de passe ou login";
            include($originDIR.'/app/views/connexion.php');
            exit;
        }
        

        // si les credantials correspondent
        // on connecte l'utilisateur en mettant ces 
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
        include($originDIR.'/app/views/connexion.php');
    }    
?>