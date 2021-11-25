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
    <?= getMessage() ?>
</header>