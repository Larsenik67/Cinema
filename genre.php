<?php 
    include "controller.php";
?>
        <div class='grille'>
<?php

    $table = "genre";
    $genre = findAll($table);

    foreach($genre as $type){

        echo "<div class='product my-1 mx-1'><a href='page-genre.php?id=".$type["id_genre"]."'>".$type["nom_genre"] ."</a></div>";
    }

?>
</div>
