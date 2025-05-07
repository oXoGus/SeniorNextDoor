<?php
  include($originDIR."/config/middleware.php"); // page uniquement accessible aux utilisateurs 
  
  // récupération de tout les utilisateur de l'éhpad
  include($originDIR."/app/models/annuaire.php");
  
  $userLst = array();

  
  // on met toutes les info des utilisateurs dans une liste
  while ($user = $res->fetch(PDO::FETCH_OBJ)){
    
    // on format l'avatar pour l'affichage
    include($originDIR.'/app/models/formatUserAvatar.php');    

    // si l'utilisateur est en amis avec le user
    $query = $cnx->query("SELECT * FROM ami WHERE id_utilisateur = $id AND id_ami = ".$user->id);
    
    // on stocke un booléen pour la view
    $user->ami = $query->rowCount() == 1;

    // on fait la meme chose pour le compte bloqué 
    $query = $cnx->query("SELECT * FROM bloquer WHERE id_utilisateur = $id AND id_utilisateur_bloque = ".$user->id);
    $user->bloque = $query->rowCount() == 1;

    $userLst[] = $user;
  }

  
  // affichage dynamique des utilisateurs
  include($originDIR."/app/views/annuaire.php");
  
?>
