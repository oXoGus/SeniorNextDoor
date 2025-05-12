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
  <?php
  include($originDIR . "/config/connexion_db.php");
  ?>
  <div class="container">
    <div class="colonne gauche">
      <div class="liste" id="liste">
        <?php
        for ($i = 0; $i < count($listeAmi); $i++) {
          $user1 = $listeAmi[$i];
          $idAmi = $user1['id'];
          $pseudo = $user1['pseudo'];
          $lib_statut = $user1['code_statut'];
          $couleur = "jaune";
          $statut = "";
          if ($lib_statut == "ENL") {
            $couleur = "vert";
            $statut = "en ligne";
          }
          if ($lib_statut == "HOL") {
            $couleur = "rouge";
          }
          echo ' <div class="img-txt2">
                    <a href="message.php?idAmi=' . $idAmi . '">
                      <img src="img/Chantalle.jpg" onclick="affichage()" />
                     </a>    
                      <div class="txt">
                        <h3 class="nom">' . $pseudo . '</h3> <p ><b class="' . $couleur . '">' . $statut . '</b></p>
                      </div>
                  </div> ';
        }
        ?>
      </div>
      <div class="profil" id="profil">
        <button onclick="affichage()"><b>&#8592;</b></button>
        <div class="avatar"><img src="img/Chantalle.jpg" /></div>
        <?php
        echo '<h2>' . $nom . '</h2>'
          ?>
        <div class="img-txt">
          <img src="img/coeur.png" />
          <p>thé</p>
        </div>
        <div class="img-txt">
          <img src="img/maison.png" />
          <p>Vit à villeneuve</p>
        </div>
        <div class="img-txt">
          <img src="img/calendrier.png" />
          <p>01/07/1800</p>
        </div>
      </div>
    </div>
    <div class="colonne droite">
      <div class="message_box">
      <?php
      if (isset($listeMsg)) {
        for ($i = 0; $i < count($listeMsg); $i++) {
          $message1 = $listeMsg[$i];
          $vue="";
          if ($message1['vue']==0){
            $vue="pas encore vue";
          }
          if ($message1['id_emeteur'] == $id) {
            echo '<div class="msgMoi">
          <div class="Imgprofil"><img src="img/Chantalle.jpg" /></div>
          <p>' . $message1['contenu_message'] . '';
           echo '</br> <i class="info">'.$vue." ". $message1['date_message']. ' </i> </p> </div>';
          } else {
            echo '<div class="msgAmi">
          <div class="Imgprofil"><img src="img/Chantalle.jpg" /></div>
          <p>' . $message1['contenu_message'] . '';
          echo '</br> <i class="info"> '. $message1["date_message"]. '</i> </p> </div>';

          }
        }
      }
      ?>
      </div>
      <div class="message">
        <form method="POST" action="">
          <?php
          echo '<input type="text" placeholder="écrire à ' . $nom . ' ..." name="message" />'
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