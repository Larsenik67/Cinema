<?php 
    include "controller.php";
?>
        <div class='grille'>
<?php

    $table = "film";
    $films = findAll($table);

    foreach($films as $film){

        echo "<div class='product my-1 mx-1'><a href='page-film.php?id=".$film["id_film"]."'>".$film["titre"] ."</a><br>".
        mb_strimwidth($film["résumé"], 0, 50, "...") ."<br>".
            $film["durée"] ."min</div>";
    }

?>
</div>
