<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/message.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <title>Chat</title>
</head>

<body>
  <div class="container">
    <div class="colonne gauche">
      <div class="liste" id="liste">
      <a href="home.php"><img class="homeIcon" src="img/home.svg"></a>
        <?php
          foreach ($listeAmi as $user) {
            
            echo "<a class=\"lienUser\" href=\"message.php?idAmi=".$user->id."\">
                  <div class=\"img-txt2\">    
                        <img src=\"$user->avatar\" onclick=\"affichage()\" />
                        <div class=\"txt\">
                          <h3 class=\"nom\">$user->pseudo</h3> <p><b class=\"$user->code_statut\">$user->lib_statut</b></p>
                        </div>
                    </div></a> ";
          }
        
        ?>
      </div>
      <div class="profil" id="profil">
        <button onclick="affichage()"><b>&#8592;</b></button>
        <div class="avatar"><img src="<?php echo $listeAmi[$idAmi]->avatar ?>" /></div>
        <?php
        echo '<h2>' . $nom . '</h2>'
          ?>
        <div class="img-txt">
          <img src="img/coeur.svg" />
          <p><?php echo $user->bio ?></p>
        </div>
        <div class="img-txt">
          <img src="img/maison.svg" />
          <p>Vit à <?php echo $user->loc ?></p>
        </div>
        <div class="img-txt">
          <img src="img/calendrier.svg" />
          <p><?php echo $user->age ?> </p>
        </div>
      </div>
    </div>
    <div class="colonne droite">
      <div class="message_box">
      <?php
      if (isset($listeMsg)) {
        foreach ($listeMsg as $message) {
          $vue="";
          if ($message->vue === 0){
            $vue="pas encore vue";
          }
          if ($message->id_emeteur == $id) {
            echo '<div class="msgMoi">
          <div class="Imgprofil"><h1>Vous</h1><img src="'.$userInfo->avatar.'" /></div>
          <p><b>' . $message->contenu_message . '</b>';
          echo '</br> <b><i class="info"> envoyé ' . $message->tempsEcoule. ($vue === "" ? "" : " - " ) . $vue .'</i></b> </p> </div>';
        } else {
            echo '<div class="msgAmi">
          <div class="ImgprofilAmi"><img src="'.$listeAmi[$idAmi]->avatar.'" /><h1>'.$listeAmi[$idAmi]->pseudo.'</h1></div>
          <p><b>' . $message->contenu_message . '</b>';
          echo '</br> <b><i class="info">reçu '. $message->tempsEcoule. '</i></b></p> </div>';

          }
        }
      }
      ?>
      </div>
      <div class="message">
        <form method="GET" action="message.php">
          <?php
          echo '<input type="text" placeholder="écrire à ' . $listeAmi[$idAmi]->pseudo . ' ..." name="message" autocomplete="off" />';
          echo '<input type="hidden" name="idAmi" value="'.$idAmi.'">';
            ?>
          <input type="submit" name="envoyer" value="">
        </form>
      </div>
    </div>
  </div>
</body>

</html>
<script src="script/affichage_msg.js"> </script>
<script src="script/actualisation.js"> </script>