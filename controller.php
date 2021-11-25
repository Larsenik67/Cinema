<?php 

ob_start();

session_start();
include "functions.php";
include "db-functions.php";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Accueil</title>
    </head>
    <body>
        <header>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="faker.php">Faker</a>
                <a href="film.php">film</a>
                <a href="realisateur.php">realisateur</a>
                <a href="acteur.php">acteur</a>
                <a href="genre.php">genre</a>
                <a href="role.php">role</a>
                <?php
                if(isset($_SESSION['user'])){
                    ?>
                    <span><?= $_SESSION['user']['username'] ?></span>
                    <a href="wishlist.php">wishlist</a>
                    <a href='security.php?action=logout'>Déconnexion</a>
                    <?php
                }
                else{
                    ?>
                    <a href="login.php">Connexion</a>
                    <a href="register.php">S'enregistrer</a>
                    <?php

                }
                ?>
            </nav>
        </header>
<?php

ob_get_contents();

?>