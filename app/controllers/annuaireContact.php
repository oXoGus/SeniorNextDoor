<?php
    $status = "ne pas déranger";
    $name = "Chantalle Dupuis";
    if ($status=="ne pas déranger") {
        $color = "orange";
    }
    else if ($status=="Hors ligne") {
        $color = "red";
    }
    else {
        $color = "green";
    }
    for ($i = 0 ; $i<10; $i+=1) {
        echo "<div class='contact'> <img src='link.png'> <p class='name'> $name </p> <br> <p class='status' color='$color'> $status </p>";
    }
    ?>