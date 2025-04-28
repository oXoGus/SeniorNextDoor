<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Annuaire - Qualité dev</title>
    <link rel="stylesheet" href="annuaire.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Anek+Devanagari:wght@100..800&display=swap" rel="stylesheet">  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  </head>
  <body>
    <a href="home.html"><img src="home.svg"></a>
    <div class="content">
        <h1><b>Annuaire</b></h1>
        <div class="bar">
            <div class="Research">
                <p><b>Rechercher ...</b></p>
            </div>
            <div class="img">
                <img class="filter" src="filter.svg" alt = "filter">
            </div>
        </div>
        <?php include('annuaireContact.php');?>
    </div>
    <script src="annuaire.js"> </script>
  </body>
</html>
