<?php 

include "controller.php";

if(isset($_GET['id'])){

    $table = "film";
    $id_name = "id_film";
    $id_tofind = $_GET['id'];
    $film = findOneById($table, $id_name, $id_tofind);
    echo $film['titre']."<br>".$film["sortie"]."<br>".$film['durée']."minutes<br>".$film['note']."<br><br>".$film['résumé']."<br><img src='".$film['affiche']."' alt='".$film['titre'];
}

?>