<?php 

include "controller.php";

if(isset($_GET['id'])){

    $table = "acteur";
    $id_tofind = $_GET['id'];
    $acteur = findOneById($table, $id_tofind);
    
    if($acteur['sexe_acteur'] == 1){
        $sexe = "Homme";
    } else {
        $sexe = "Femme";
    }

    echo $acteur["nom_acteur"] ." ".$acteur['prenom_acteur']."</a><br>".
    $sexe."<br>Née le ".$acteur['naissance_acteur']."</div>";
}

?>