<?php 

include "controller.php";

if(isset($_GET['id'])){

    $table = "role";
    $id = $_GET['id'];
    $genre = role2Casting($table, $id);

    foreach($genre as $type){

        echo "<a href='page-acteur.php?id=".$type["id_acteur"]."'>".$type["nom_acteur"] ."</a> dans <a href='page-film.php?id=".$type["id_film"]."'>".$type["titre"] ."</a><br>";
    }
}

?>