<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cnx.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
    <title>Votre compte</title>
</head>
<body>
    
    <div class="fexRowCenter">
        <img src="img/waveLeft.svg" alt="">
        <div class="loginContainer" style="height: auto;">
            <form action="createAcount.php" method="post">
            <h2 style="margin: 10px;">Modifier votre compte</h2>
                <div style="margin: 10px;">
                    <p>Nom</p>
                    <input type="text" name="nom">
                    <p>Prénom</p>
                    <input type="text" name="prenom">
                    <p>Date de naissance</p>
                    <input type="date" name="dateNaiss" id="">
                    <p>Nom que les autres utilisateurs verront</p>
                    <input type="text" name="pseudo">
                    <p>Votre avatar</p>
                    <input type="file" name="avatar" id="" text="Choisir une image" accept="image/*">
                    <p>Une courte phrase pour vous décrire</p>
                    <textarea name="bio" id=""></textarea>
                    <input id="submitBtn" type="submit" value="Enregristrer les modifications">
                </div>
                
            </form>
        </div>
        <img src="img/waveRight.svg" alt="">
        <a href="profil"><img id="btnBack" src="img/btnBack.svg" alt=""></a>
    </div>
</body>
</html>