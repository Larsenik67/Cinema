<?php 

include "db-functions.php";
echo "<a href='index.php'>Back</a><br><br>";

if(isset($_GET['id'])){

    $table = "film";
    $id_film = $_GET['id'];
    $film = findOneById($table, $id_film);
    echo $film['titre']."<br>".$film["sortie"]."<br>".$film['durée']."minutes<br>".$film['note']."<br><br>".$film['résumé']."<br><img src='".$film['affiche']."' alt='".$film['titre'];
}

?>