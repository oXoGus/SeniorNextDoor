<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/cnx.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
    <title>Votre compte</title>
</head>
<body>
    
    <div class="fexRowCenter">

        <a id="btnBack" href="profil.php"><img src="img/btnBack.svg" alt=""></a>

        <img src="img/waveLeft.svg" alt="">
        <div class="loginContainer" >
            <!-- ne pas oublier le enctype="multipart/form-data" et le post pour upload l'avatar-->
            <form enctype="multipart/form-data" action="compte.php" method="POST">
            <h2 style="margin: 10px;">Modifier votre compte</h2>
                <div style="margin: 10px;">
                    <p>Nom que les autres utilisateurs verront</p>
                    <input type="text" name="pseudo" value=<?php echo "\"".$user->pseudo."\""?>>
                    <p>Votre avatar actuel</p>
                    <div class="containerVertialCenter" >
                        <img class="avatar" src="<?php echo $user->avatar ?>" alt="votre avatar">
                    </div>
                    <p>Pour changer votre avatar</p>
                    <input type="file" name="avatar" id="avatar" text="Choisir une image" accept="image/*" >
                    <p>votre bio</p>
                    <textarea name="bio" id="" ><?php echo $user->bio ?></textarea>
                    <p>Votre statut</p>
                    <div style="display: flex; justify-content: space-around">
                        <div class="containerVertialCenter">
                            
                            <input type="radio" name="code_statut" value="ENL" id="btnRadio" <?php  if ($user->code_statut == "ENL"){ echo"checked"; } ?>> 
                            <p>en ligne</p>
                        </div>
                        <div class="containerVertialCenter">
                            <input type="radio" name="code_statut" value="NPD" id="btnRadio" <?php if ($user->code_statut == "NPD"){ echo"checked"; } ?>>
                            <p>ne pas déranger</p>
                        </div>
                        <div class="containerVertialCenter">
                            <input type="radio" name="code_statut" value="INA" id="btnRadio" <?php if ($user->code_statut == "INA"){ echo"checked"; } ?>>
                            <p>inactif</p>
                        </div>
                    </div>
                    <input id="submitBtn" type="submit" value="Enregristrer les modifications">
                </div>
            </form>
            <?php
                // gestion des erreurs 
                if (isset($err)){
                    echo "<p class=\"err\">$err</p>";
                    unset($err);
                }
                if (isset($message)){
                    echo "<p class=\"msg\">$message</p>";
                    unset($message);
                }
            ?>
        </div>
        <img src="img/waveRight.svg" alt="">
    </div>
</body>
</html>