<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cnx.css">
    <link rel="stylesheet" href="cnx.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <title>Créer un compte</title>
</head>
<body>
    <div class="fexRowCenter">
        <img src="img/waveLeft.svg" alt="">
        <div class="loginContainer" style="height: auto;">
            <form action="createAcount.php" method="post">
            <h2 style="margin: 10px;">Connexion</h2>
                <div style="margin: 10px;">
                    <p>Adresse Mail</p>
                    <input type="text" name="login">
                    <p>Mot de passe</p>
                    <input type="text" name="mdp">
                    <p>Confirmer le mot de passe</p>
                    <input type="text" name="mdpConf">
                    <input id="submitBtn" type="submit" value="Créer votre compte">
                </div>
                
            </form>
            <p style="text-align: center;">J'ai déja un compte ? <a href="connexion.php">Se connecter</a></p>
        </div>
        <img src="img/waveRight.svg" alt="">
    </div>
</body>
</html>