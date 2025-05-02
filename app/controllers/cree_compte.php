<?php

    // si l'utilisateur vient de remplir le form 
    // et donc de faire une requete GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET'){ // === permet de comparer les val et les types

        // 2ème verif que l'utilsateur a bien tout remplit
        if (empty($_GET['login']) || empty($_GET['mdp']) || empty($_GET['mdpConf'])){
            header('location: /SeniorNextDoor/cree_compte.php');
        }
        else {

            // recup des info du senior
            $login = $_GET['login'];
            $mdp = $_GET['mdp'];
            $mdpConf = $_GET['mdpConf'];

            if ($mdp != $mdpConf){
                // on crée l'erreur
                $err = "les deux mots de passe ne sont pas identiques";
                header('location: /SeniorNextDoor/cree_compte.php');
            }
            else {

                // on appel le model pour créer un compte
                include('../app/model/cree_compte.php');


            
            }

            
            

            
        }
    }
    // si l'utilisateur n'a pas envoyé le form
    else {

        // on affiche le form 
        include('../app/views/cree_compte.php');
    }    
?>