<?php 

include "controller.php";

if(isset($_GET['id'])){

    $table = "acteur";
    $id_tofind = $_GET['id'];
    $id = $id_tofind;
    $acteur = findOneById($table, $id_tofind);
    
    $casting = acteur2Film($table, $id);
    
    if($acteur['sexe_acteur'] == 1){
        $sexe = "Homme";
    } else {
        $sexe = "Femme";
    }

    echo $acteur["nom_acteur"] ." ".$acteur['prenom_acteur']."</a><br>".
    $sexe."<br>Née le ".$acteur['naissance_acteur']."</div><br><br>
    <h1>Filmographie</h2><br>";

    foreach($casting as $cast){

        echo "Joue <a href='page-role.php?id=".$cast["id_role"]."'>".$cast["nom_role"] ."</a> dans <a href='page-film.php?id=".$cast["id_film"]."'>".$cast["titre"] ."<br> ".$cast['sortie']."</a> 
        <br>Résumé: ".$cast["résumé"]."<br><br>";
    }
}

?>