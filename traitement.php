<?php
    session_start();
    include "functions.php";
    include "db-functions.php";
    include 'vendor/autoload.php';

    $action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_REGEXP, [
        "options" => [
            "regexp" => "/addFilm|addReal|addActeur|linkGenre|linkCasting|addRole|updateQtt|deleteProd|deleteAll/"
        ]
    ]);

    if($action){

        switch($action){

            case "addFilm":
                if(isset($_POST['submit'])){

                    $loop = filter_input(INPUT_POST, "qtt", FILTER_DEFAULT);

                    for($i = 1; $i <= $loop; $i++){
                        $faker = Faker\Factory::create();

                        $titre = $faker->company;
                        $sortie = $faker->date($format = 'Y-m-d', $max = 'now');
                        $durée = Rand(30, 180);
                        $résumé = $faker->realText(500);
                        $note = Rand(0, 5);
                        $affiche = $faker->imageUrl($width = 640, $height = 480);

                        $colonne = "id_realisateur";
                        $table = "realisateur";
                        $nombre = 1;
                        $id_realisateur = randomData($colonne, $table, $nombre);
                        
                        insertFilm($titre, $sortie, $durée, $résumé, $note, $affiche, $id_realisateur);
                    }

                    redirect("film.php");
            
                }
                else{
                    setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                }
                redirect("faker.php");
                break;

            case "addReal":
                if(isset($_POST['submit'])){

                    $loop = filter_input(INPUT_POST, "qtt", FILTER_DEFAULT);

                    for($i = 1; $i <= $loop; $i++){
                        $faker = Faker\Factory::create();

                        $nom_real = $faker->lastName;
                        $prenom_real = $faker->firstName;
                        $sexe_real = Rand(0, 1);
                        $naissance_real = $faker->date($format = 'Y-m-d', $max = '01-01-2000');
                        
                        insertReal($nom_real, $prenom_real, $sexe_real, $naissance_real);
                    }

                    redirect("realisateur.php");
            
                }
                else{
                    setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                }
                redirect("faker.php");
                break;

            case "addActeur":
                if(isset($_POST['submit'])){

                    $loop = filter_input(INPUT_POST, "qtt", FILTER_DEFAULT);

                    for($i = 1; $i <= $loop; $i++){
                        $faker = Faker\Factory::create();

                        $nom_acteur = $faker->lastName;
                        $prenom_acteur = $faker->firstName;
                        $sexe_acteur = Rand(0, 1);
                        $naissance_acteur = $faker->date($format = 'Y-m-d', $max = '01-01-2000');
                        
                        insertActeur($nom_acteur, $prenom_acteur, $sexe_acteur, $naissance_acteur);
                    }

                    redirect("acteur.php");
            
                }
                else{
                    setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                }
                redirect("faker.php");
                break;

            case "linkGenre":
                if(isset($_POST['submit'])){

                    $loop = filter_input(INPUT_POST, "qtt", FILTER_DEFAULT);

                    for($i = 1; $i <= $loop; $i++){

                        $colonne = "id_genre";
                        $table = "genre";
                        $nombre = 1;
                        $id_genre = randomData($colonne, $table, $nombre);

                        $colonne = "id_film";
                        $table = "film";
                        $nombre = 1;
                        $id_film = randomData($colonne, $table, $nombre);
                        
                        linkGenre($id_genre, $id_film);
                    }

                    redirect("genre.php");
            
                }
                else{
                    setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                }
                redirect("faker.php");
                break;

            case "addRole":
                if(isset($_POST['submit'])){

                    $loop = filter_input(INPUT_POST, "qtt", FILTER_DEFAULT);

                    for($i = 1; $i <= $loop; $i++){
                        $faker = Faker\Factory::create();

                        $nom_role = $faker->name;
                        
                        insertRole($nom_role);
                    }

                    redirect("role.php");
            
                }
                else{
                    setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                }
                redirect("faker.php");
                break;

            case "linkCasting":
                if(isset($_POST['submit'])){

                    $loop = filter_input(INPUT_POST, "qtt", FILTER_DEFAULT);

                    for($i = 1; $i <= $loop; $i++){

                        $colonne = "id_film";
                        $table = "film";
                        $nombre = 1;
                        $id_film = randomData($colonne, $table, $nombre);

                        $colonne = "id_role";
                        $table = "role";
                        $nombre = 1;
                        $id_role = randomData($colonne, $table, $nombre);

                        $colonne = "id_acteur";
                        $table = "acteur";
                        $nombre = 1;
                        $id_acteur = randomData($colonne, $table, $nombre);
                        
                        linkCasting($id_film, $id_role, $id_acteur);
                    }

                    redirect("index.php");
            
                }
                else{
                    setMessage("error", "Sale pirate de ta maman, tu valides le formulaire STP !");
                }
                redirect("faker.php");
                break;
                        
            case "updateQtt":
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
                $mode = filter_input(INPUT_GET, "mode", FILTER_VALIDATE_REGEXP, [
                    "options" => [
                        "regexp" => "/incr|decr/"
                    ]
                ]);

                //$id == 0 est équivalent à id == false ou id == null
                if($id >= 0 && $mode){
                    switch($mode){
                        case "incr":
                            $_SESSION["products"][$id]["qtt"]++;
                            break;
                        case "decr":
                            $_SESSION["products"][$id]["qtt"]--;
                            
                            if($_SESSION["products"][$id]["qtt"] == 0){
                                redirect("traitement.php?action=deleteProd&id=$id");
                            }
                            break;
                    }
                }
                else setMessage("error", "Problème de requête, réessayez !");
                break;

            case "deleteProd": 
                $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

                if(isset($_SESSION['products'][$id])){
                    $name = $_SESSION['products'][$id]["name"];//récupère le nom du produit qui va être supprimé
                    unset($_SESSION['products'][$id]);//on le supprime
                    /*------ACHTUNG------*/
                    $_SESSION["products"] = array_values($_SESSION["products"]);//réattribue les index des produits restants
                    /*----fin ACHTUNG----*/
                    setMessage("success", "Le produit $name a été supprimé !");
                }
                else setMessage("error", "Le produit n'existe pas !");
                break;
            
            case "deleteAll": 
                if(isset($_SESSION['products'])){
                    unset($_SESSION['products']);
                    setMessage("success", "Votre panier a été vidé avec succès !");
                }
                else setMessage("error", "Pas de panier... pas de panier !");
                break;
        }
    }

    redirect("index.php");