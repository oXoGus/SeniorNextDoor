<?php
  include($originDIR."/config/middleware.php"); // page uniquement accessible aux utilisateurs 
  
  // récupération de tout les utilisateur de l'éhpad
  include($originDIR."/app/models/annuaire.php");
  
  $userLst = array();

  
  // on met toutes les info des utilisateurs dans une liste
  while ($user = $res->fetch(PDO::FETCH_OBJ)){
    
    // on format l'avatar pour l'affichage
    include($originDIR.'/app/models/formatUserAvatar.php');    

    
    $query = $cnx->query("SELECT * FROM ami WHERE (id_utilisateur = $id AND id_ami = ".$user->id.") OR (id_utilisateur = $user->id AND id_ami = ".$id.")");
    
    // si les deux utilisateurs sont ami respectivement
    if ($query->rowCount() === 2){
      $user->ami = true;
      $query->closeCursor();
    } else {
      $query = $cnx->query("SELECT * FROM ami WHERE id_utilisateur = $id AND id_ami = ".$user->id);

      // si on à  fait une demande d'ami qui n'a pas été encore accepté 
      if ($query->rowCount() === 1){
        $user->ami = "demande en attente";
        $query->closeCursor();
      
      } else {
        $user->ami = false;
        $query->closeCursor();
      }
    }
  
    $userLst[] = $user;
  }

  
  // affichage dynamique des utilisateurs
  include($originDIR."/app/views/annuaire.php");
  
?>
