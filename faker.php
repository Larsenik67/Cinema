<?php 
    include "controller.php";
?>
    <h1>Ajouter des realisateurs random via Faker</h1>
        <form action="traitement.php?action=addReal" method="post">
            <p>
                <label>
                    Quantité :
                    <input type="number" step="any" name="qtt">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        <br><br>
        <h1>Ajouter des films random via Faker</h1>
        <form action="traitement.php?action=addFilm" method="post">
            <p>
                <label>
                    Quantité :
                    <input type="number" step="any" name="qtt">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        <br><br>
        <h1>Ajouter des acteurs random via Faker</h1>
        <form action="traitement.php?action=addActeur" method="post">
            <p>
                <label>
                    Quantité :
                    <input type="number" step="any" name="qtt">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        <br><br>
        <h1>Associer des genres random a des films via Faker</h1>
        <form action="traitement.php?action=linkGenre" method="post">
            <p>
                <label>
                    Quantité :
                    <input type="number" step="any" name="qtt">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        <br><br>
        <h1>Ajouter des roles random via Faker</h1>
        <form action="traitement.php?action=addRole" method="post">
            <p>
                <label>
                    Quantité :
                    <input type="number" step="any" name="qtt">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
        <br><br>
        <h1>Assembler des castings random via Faker</h1>
        <form action="traitement.php?action=linkCasting" method="post">
            <p>
                <label>
                    Quantité :
                    <input type="number" step="any" name="qtt">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit">
            </p>
        </form>
    </body>
</html>