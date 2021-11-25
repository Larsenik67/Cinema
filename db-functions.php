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
function findAll($table){

    $table = filter_var($table, FILTER_SANITIZE_STRING);

    $db = connexion();
    $query = "SELECT * FROM $table";
    $stmt = $db->query($query);
    
    return $stmt->fetchAll();

}

function findOneById($table, $id_tofind){

    $db = connexion();
    $query = "SELECT * FROM $table WHERE id_$table = $id_tofind";
    $stmt = $db->query($query);

    return $stmt->fetch();
}

function randomData($colonne, $table, $nombre){
    $db = connexion();
    $query = "SELECT $colonne FROM $table ORDER BY rand() LIMIT $nombre";
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

function insertActeur($nom_acteur, $prenom_acteur, $sexe_acteur, $naissance_acteur){
    $db = connexion();
    $query = "INSERT INTO acteur (nom_acteur, prenom_acteur, sexe_acteur, naissance_acteur)
              VALUES (:nom_acteur, :prenom_acteur, :sexe_acteur, :naissance_acteur)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ":nom_acteur" => $nom_acteur,
        ":prenom_acteur" => $prenom_acteur,
        ":sexe_acteur" => $sexe_acteur,
        ":naissance_acteur" => $naissance_acteur,
    ]);

    return $db->lastInsertId();

}

function linkGenre($id_genre, $id_film){
    $db = connexion();
    $query = "INSERT INTO classer_genre (id_genre, id_film)
              VALUES (:id_genre, :id_film)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ":id_genre" => $id_genre,
        ":id_film" => $id_film
    ]);

    return $db->lastInsertId();

}

function film2Genre($table, $id){

    $db = connexion();
    $query = "SELECT * FROM classer_genre cg 
            INNER JOIN film f ON cg.id_film = f.id_film  
            INNER JOIN genre g ON cg.id_genre = g.id_genre 
            WHERE cg.id_$table = $id";
    $stmt = $db->query($query);

    return $stmt->fetchAll();
}

function insertRole($nom_role){
    $db = connexion();
    $query = "INSERT INTO role (nom_role)
              VALUES (:nom_role)";
    $stmt = $db->prepare($query);
    $stmt->execute([":nom_role" => $nom_role]);
}

function linkCasting($id_film, $id_role, $id_acteur){
    $db = connexion();
    $query = "INSERT INTO casting (id_film, id_role, id_acteur)
              VALUES (:id_film, :id_role, :id_acteur)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ":id_film" => $id_film,
        ":id_role" => $id_role,
        ":id_acteur" => $id_acteur,
    ]);

    return $db->lastInsertId();

}

function role2Casting($table, $id){

    $db = connexion();
    $query = "SELECT * FROM casting c
            INNER JOIN film f ON c.id_film = f.id_film  
            INNER JOIN role r ON c.id_role = r.id_role
            INNER JOIN acteur a ON c.id_acteur = a.id_acteur 
            WHERE c.id_$table = $id";
    $stmt = $db->query($query);

    return $stmt->fetchAll();
}

function real2Film($table, $id){

    $db = connexion();
    $query = "SELECT * FROM film f
            INNER JOIN realisateur r ON f.id_realisateur = r.id_realisateur
            WHERE f.id_$table = $id";
    $stmt = $db->query($query);

    return $stmt->fetchAll();
}

function acteur2Film($table, $id){

    $db = connexion();
    $query = "SELECT * FROM casting c
            INNER JOIN acteur a ON c.id_acteur = a.id_acteur
            INNER JOIN film f ON c.id_film = f.id_film
            INNER JOIN role r ON c.id_role = r.id_role
            WHERE c.id_$table = $id";
    $stmt = $db->query($query);

    return $stmt->fetchAll();
}
?>