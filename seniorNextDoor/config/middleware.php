<?php
// toujour lancer la session si on veut utiliser la var globale
session_start(); // ATTENTION : ne pas mettre d'espace ou de tab avant le session_start
    
    // verifiaction des bon pseudo et mdp
    if (isset($_SESSION['login']) && isset($_SESSION['mdp']) && isset($_SESSION['id'])){
        include($originDIR."/config/connexion_db.php");
        
        $login = $_SESSION['login'];
        $mdp = $_SESSION['mdp'];
        $id = $_SESSION['id'];

        // requete de verification
        // recuperation du hash
        $res = $cnx->query("SELECT * FROM compte where id = $id and login = ".$cnx->quote($login)." and mdp = ".$cnx->quote($mdp));
        
        // si il y'a bien un utilisateur correspondant au login et au mdp
        if ($res->fetch(PDO::FETCH_OBJ)){
            // on laisse l'utilisateur aller sur la page
        }
        else {
            header('location: /SeniorNextDoor/public/connexion.php');
        }
    }
    else {
        header('location: /SeniorNextDoor/public/connexion.php');
    }
?>