<?php 
    include "controller.php";
?>
        <div class='grille'>
<?php

    $table = "role";
    $role = findAll($table);

    foreach($role as $acting){

        echo "<div class='product my-1 mx-1'><a href='page-role.php?id=".$acting["id_role"]."'>".$acting["nom_role"] ."</a></div>";

    }

?>
</div>
