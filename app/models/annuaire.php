<?php
  include($originDIR."/config/connexion_db.php");
  
  // si l'utilisateur a rechercher un pseudo spécifique
  if (isset($_GET['searchInput']) && !empty($_GET['searchInput'])){
    $pseudoSearched = $_GET['searchInput'];
    $res = $cnx->query("SELECT id, pseudo, code_statut, lib_statut, avatar, avatar_img_type FROM utilisateur NATURAL JOIN statut WHERE pseudo LIKE ".$cnx->quote($pseudoSearched."%"));
  } else {
    $pseudoSearched = "";
    $res = $cnx->query("SELECT id, pseudo, code_statut, lib_statut, avatar, avatar_img_type FROM utilisateur NATURAL JOIN statut "); 
  }
?>
