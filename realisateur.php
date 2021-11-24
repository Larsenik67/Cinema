<?php 
    include "controller.php";
?>
        <div class='grille'>
<?php

    $table = "realisateur";
    $realisateurs = findAll($table);

    foreach($realisateurs as $real){

        if($real['sexe_real'] == 1){
            $sexe = "Homme";
        } else {
            $sexe = "Femme";
        }

        echo "<div class='product my-1 mx-1'><a href='page-realisateur.php?id=".$real["id_realisateur"]."'>".$real["nom_real"] ." ".$real['prenom_real']."</a><br>".
        $sexe."<br>Née le ".$real['naissance_real']."</div>";
    }

?>
</div>
