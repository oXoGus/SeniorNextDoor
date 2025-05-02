<?php

    // si l'utilisateur à bien remplis le from
    if (empty($_GET['login']) || empty($_GET['mdp']) || empty($_GET['mdpConf'])){
        header('location: /SeniorNextDoor/cree_compte.php');
    }
    else {
        
        
        // recup des info du senior
        $login = $_GET['login'];
        $mdp = $_GET['mdp'];
        $mdpConf = $_GET['mdpConf'];

        if ($mdp != $mdpConf){
            header('location: /SeniorNextDoor/cree_compte.php');
        }
    }
?>