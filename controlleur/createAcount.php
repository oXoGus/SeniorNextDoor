<?php

    header('location: /qual-dev/cree_compte.php');
    // si l'utilisateur à bien remplis le from
    if (!isset($_POST['login']) || !isset($_POST['mdp']) || !isset($_POST['mdpConf'])){
        header('location: /SeniorNextDoor/cree_compte.php');
    }

    // cnx à la bdd
    //include('model/connexion.inc.php');
    
    // recup des info du senior
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $mdpConf = $_POST['mdpConf'];

    if ($mdp != $mdpConf){
        header('cree_compte.php');
    }
?>