<?php

/*
 * création d'objet PDO de la connexion qui sera représenté par la variable $cnx
 */
$user =  "doyen";
$pass = "ChantalThomas";
$db = "senior_db";
$host = "127.0.0.1";


try {
    $cnx = new PDO(
        "pgsql:host=$host;dbname=$db;", 
        $user, 
        $pass
    );

}
catch (PDOException $e) {
    echo "ERREUR : La connexion a échouée : ";
    echo $e;
    echo phpinfo();

 /* Utiliser l'instruction suivante pour afficher le détail de erreur sur la
 * page html. Attention c'est utile pour débugger mais cela affiche des
 * informations potentiellement confidentielles donc éviter de le faire pour un
 * site en production.*/
//    echo "Error: " . $e;

}

?>

