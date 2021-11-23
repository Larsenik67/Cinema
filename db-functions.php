<?php 

/**
 * Retourne une instance de PDO, représentant la connexion a la DB
 * @return PDO - un objet instance de PDO, connecté à la DB
 */
function connexion() {

    $db = new PDO(
        "mysql:dbname=cinema;host=localhost:3306",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ]
    );

    return $db;

}

/**
 * Permet de sortir toute les données du tableau "film"
 */
function findAll(){

    $db = connexion();
    $query = "SELECT * FROM film";
    $stmt = $db->query($query);
    
    return $stmt->fetchAll();

}

function findOneById($table, $id_film){

    $db = connexion();
    $query = "SELECT * FROM ".$table." WHERE id_film = ".$id_film;
    $stmt = $db->query($query);

    return $stmt->fetch();
}

function randomReal(){
    $db = connexion();
    $query = "SELECT id_realisateur FROM realisateur ORDER BY rand() LIMIT 1";
    $stmt = $db->query($query);
    $stmt->execute();

    return implode($stmt->fetch());
}

/**
 * Insère un produit dans la DB
 * @param string $name -    le nom du produit
 * @param string $descr -   la description du produit
 * @param float $price -    le prix du produit
 * 
 * @see 
 * 
 * @return bool             TRUE si l'ajout en DB à fonctionné, FALSE dans le cas inverse
 */
function insertFilm($titre, $sortie, $durée, $résumé, $note, $affiche, $id_realisateur){
    $db = connexion();
    $query = "INSERT INTO film (titre, sortie, durée, résumé, note, affiche, id_realisateur)
              VALUES (:titre, :sortie, :duree, :resume, :note, :affiche, :id_realisateur)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":titre", $titre);
    $stmt->bindParam(":sortie", $sortie);
    $stmt->bindParam(":duree", $durée);
    $stmt->bindParam(":resume", $résumé);
    $stmt->bindParam(":note", $note);
    $stmt->bindParam(":affiche", $affiche);
    $stmt->bindParam(":id_realisateur", $id_realisateur);
    $stmt->execute();
    return intval($db->lastInsertId());

}

function insertReal($nom_real, $prenom_real, $sexe_real, $naissance_real){
    $db = connexion();
    $query = "INSERT INTO realisateur (nom_real, prenom_real, sexe_real, naissance_real)
              VALUES (:nom_real, :prenom_real, :sexe_real, :naissance_real)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ":nom_real" => $nom_real,
        ":prenom_real" => $prenom_real,
        ":sexe_real" => $sexe_real,
        ":naissance_real" => $naissance_real,
    ]);

    return $db->lastInsertId();

}

?>