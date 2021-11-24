<?php 

include "controller.php";

if(isset($_GET['id'])){

    $table = "realisateur";
    $id_tofind = $_GET['id'];
    $id = $id_tofind;
    $realisateur = findOneById($table, $id_tofind);
    
    $casting = real2Film($table, $id);
    
    if($realisateur['sexe_real'] == 1){
        $sexe = "Homme";
    } else {
        $sexe = "Femme";
    }

    echo $realisateur["nom_real"] ." ".$realisateur['prenom_real']."</a><br>".
    $sexe."<br>Née le ".$realisateur['naissance_real']."</div><br><br>
    <h1>Filmographie</h2><br>";

    foreach($casting as $cast){

        echo "<a href='page-film.php?id=".$cast["id_film"]."'>".$cast["titre"] ."<br> ".$cast['sortie']."</a> 
        <br>Résumé: ".$cast["résumé"]."<br><br>";
    }


}

?>