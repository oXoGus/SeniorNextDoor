<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Annuaire - Qualité dev</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="style/annuaire.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <a href="home.php"><img class="homeIcon" src="img/home.svg"></a>
    <div class="content">
        <h1><b>Annuaire</b></h1>
        <form action="annuaire.php" method="get">
          <input name="searchInput" class="bar" placeholder="rechercher un utilisateur" type="text" <?php if(isset($pseudoSearched)){ echo "value=\"$pseudoSearched\""; }?>>    
          <div style="display: flex; justify-content: space-between;">
            <input class="submitBtn" type="submit" value="rechercher">
            <a class="resetBtn" href="annuaire.php">réinitialiser</a>
          </div>
        </form>
        <div class="userList">
          <?php
            if (!empty($userLst)){
              foreach ($userLst as $user){
                echo "<div id=\"".$user->pseudo."\" class=\"user\">\n";
                  echo "<div style=\"display: flex; align-items: center;\">\n";
                    echo "<img class=\"userIcon\" src=\"".$user->avatar."\" alt=\"avatar de ".$user->pseudo."\">\n";
                    echo "<div class=\"userInfo\">\n";
                      echo "<p class=\"username\">".$user->pseudo."</p>\n";
                      echo "<p class=\"userStatus ".$user->code_statut."\">".$user->lib_statut."</p>\n";
                    echo "</div>\n";
                  echo "</div>\n";
                  echo "<div class=\"userIconsContainer\">\n";
                    // on n'affiche pas les icones pour s'ajouter soit meme en ami ou se bloquer soit meme
                    if ($user->id === $id){
                      echo "<p>c'est vous</p>\n";
                    } elseif($user->id === 0) {
                      echo "<p>admin</p>";
                    } else {
                      if ($user->ami === "demande en attente") {
                        echo "<p>".$user->ami."</p>";
                      } elseif ($user->ami === true){
                        echo "<img style=\"margin-bottom: 3px; padding-right: 5px\"src=\"img/Friend.svg\"/>\n";
                      }
                      // on change la couleur des icones si l'utilisateur est bloqué ou non 
                      echo "<a href=\"addFriend.php?id=".$user->id."&searchInput=$pseudoSearched\">\n";
                      if ($user->ami){
                        echo "<img src=\"img/deleteFriend.svg\"/>\n";
                      } else{
                        echo "<img src=\"img/addFriendIcon.svg\"/>\n";
                      } 
                      echo "</a>\n";
                    }
                  echo "</div>\n";
                echo "</div>\n";
              }
            } else {
              echo "<p class=\"msg\">Aucun utilisateur avec ce pseudo</p>";
            }
          ?>
        </div>    
    </div>
  </body>
</html>
