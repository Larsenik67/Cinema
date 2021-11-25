<?php 

include "controller.php";

if(isset($_SESSION['user'])){

    $id =  $_SESSION['user']['id_user'];

    $wishlistFilm = wishlistFilm($id);
    $wishlistRealisateur = wishlistReal($id);
    $wishlistActeur = wishlistActeur($id);

    echo "<h1>Films préférés: </h1><br>";

    foreach($wishlistFilm as $film){
        echo "<a href='page-film.php?id=".$film['id_film']."'>".$film['titre'] ."</a><br>";

    }

    echo "<br><br><h1>Realisateur préférés: </h1><br>";

    foreach($wishlistRealisateur as $real){
        echo "<a href='page-realisateur.php?id=".$real["id_realisateur"]."'>".$real["nom_real"] ." ".$real['prenom_real']."</a><br>";

    }

    echo "<br><br><h1>Acteur  préférés: </h1><br>";

    foreach($wishlistActeur as $act){
        echo "<a href='page-acteur.php?id=".$act['id_acteur']."'>".$act['nom_acteur'] ." ".$act['prenom_acteur']."</a><br>";

    }
}else {
    echo "C'est vide!";
}

?>