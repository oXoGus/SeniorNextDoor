<?php
    if(isset($_POST)){
        foreach ($_POST as $cle => $valeur) {
            echo "$cle => $valeur<br/>\n";
        }
    }
    else{
        echo "Aucune données stockées";
    }
?>