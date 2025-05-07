<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/profil.css">
    <title>Profil</title>
</head>
<body>
    <a href="home.php"><img style="position: absolute; top: 20px; left: 20px;" src="img/btnHome.svg" alt=""></a>
    <div style="display: flex; flex-direction: column; align-items: center;">
        <div class="divCenter">
            <img class="userIcon" src="<?php echo $user->avatar ?>" alt="votre avatar">
            <h1><?php echo $pseudo ?></h1>
            <p class="userStatus <?php echo $user->code_statut ?>"><?php echo $user->lib_statut?></p>
            <a href="compte.php"><img style="position: absolute; top: 20px; left: 20px; width: 115px;" src="img/btnModifCompte.svg" alt=""></a>
            <div class="descContainer">
                <div class="desc">
                    <img src="img/bio.svg" alt="">
                    <p><?php echo $bio ?></p>
                </div>
                <div class="desc">
                    <img src="img/homeIcon.svg" alt="">
                    <p><?php echo $loc ?></p>
                </div>
                <div class="desc">
                    <img src="img/ageIcon.svg" alt="">
                    <p><?php echo $age ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>