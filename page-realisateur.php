<?php 

include "controller.php";

if(isset($_GET['id'])){

    $table = "realisateur";
    $id_tofind = $_GET['id'];
    $realisateur = findOneById($table, $id_tofind);
    
    if($realisateur['sexe_real'] == 1){
        $sexe = "Homme";
    } else {
        $sexe = "Femme";
    }

    echo $realisateur["nom_real"] ." ".$realisateur['prenom_real']."</a><br>".
    $sexe."<br>Née le ".$realisateur['naissance_real']."</div>";
}

?>