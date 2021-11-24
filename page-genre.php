<?php 

include "controller.php";

if(isset($_GET['id'])){

    $table = "genre";
    $id = $_GET['id'];
    $genre = film2Genre($table, $id);

    foreach($genre as $type){

        echo "<a href='page-film.php?id=".$type["id_film"]."'>".$type["titre"] ."</a><br>";
    }
}

?>