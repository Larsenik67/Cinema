<?php 

include "controller.php";

if(isset($_GET['id'])){

    $table = "film";
    $id_tofind = $_GET['id'];
    $id = $id_tofind;
    
    $film = findOneById($table, $id_tofind);
    $casting = role2Casting($table, $id);
    $genre = film2Genre($table, $id);

    echo "<h1>".$film['titre']."</h1><br>
        <form action='traitement.php?id=".$id."&action=addFilmToFav' method='post'>
            <p>
                <input type='submit' name='submit' value='Ajouter le film a vos favoris'>
            </p>
        </form><br>
        genre(s) : ";

    foreach($genre as $type){

        echo $type['nom_genre']." ";

    }

    echo "<br>".$film["sortie"]."<br>".$film['durée']."minutes<br>".$film['note']."/5<br><br>".$film['résumé']."<br><img src='".$film['affiche']."' alt='".$film['titre']."'>
    <br><h1>Casting</h1><br>";

    foreach($casting as $cast){

        echo "<a href='page-acteur.php?id=".$cast["id_acteur"]."'>".$cast["nom_acteur"] ." ".$cast['prenom_acteur']."</a> 
        dans le role de <a href='page-role.php?id=".$cast["id_role"]."'>".$cast['nom_role']."</a><br>";
    }
}

?>