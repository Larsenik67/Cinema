<?php 
    include "controller.php";
?>
        <div class='grille'>
<?php

    $table = "acteur";
    $acteurs = findAll($table);

    foreach($acteurs as $act){

        if($act['sexe_acteur'] == 1){
            $sexe = "Homme";
        } else {
            $sexe = "Femme";
        }

        echo "<div class='product my-1 mx-1'><a href='page-acteur.php?id=".$act["id_acteur"]."'>".$act["nom_acteur"] ." ".$act['prenom_acteur']."</a><br>".
        $sexe."<br>Née le ".$act['naissance_acteur']."</div>";
    }

?>
</div>
