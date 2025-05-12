<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Annuaire</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="style/home.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div class="profil">
    <a href="profil.php">
    <img class="avatar" src="<?php echo $user->avatar ?>" alt="votre avatar">
</a>
    <p><b><?php echo $user->pseudo ?></b></p>
</div>
<div class="menu">
    <a href="annuaire.php"><img src="img/Annuaire.png"></a>
    <a href="CalendrierGlobal.html"><img src="img/Calendrier.png"></a>
    <a href="messages.html"><img src="img/Messages.png"></a>
</div>
</div>
</body>
</html>
