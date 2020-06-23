# Création de la base de données
- nom : dashboard
- utf8_unicode_ci

# Création de la table
- light-change
- utf8_unicode_ci
- id / date_change / floor / position / power / brand

utf8_unicode_ci
moteur de stockage : MyISAM

# Créer la page de connexion à la base de données
- db.php

<?php
define('DATABASE', 'dashboard');
define('USER', 'root');
define('PWD', '');
define('HOST', 'localhost');
try {
    $dbh = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PWD);
} 
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

## Relier le fichier index.php à db.php
Mettre cette ligne tout en haut du fichier index.php au dessus du html
<?PHP 
    require_once('db.php');
?>

# Création du listing <html> qui affichera toutes les entrées avec les buttons add, edit et delete
<div class="container">
    <!-- Titles of the dashboard -->
    <h1>COMMON BUILDING</h1>
        <h2>Listing Light Change</h2>
            <!-- Listing of the dashboard -->
            <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col" type="checkbox">check</th>
                <th scope="col">#</th>
                <th scope="col">Date change</th>
                <th scope="col">Floor</th>
                <th scope="col">Location</th>
                <th scope="col">Power</th>
                <th scope="col">Brand</th>
                </tr>
            </thead>
            </table>
            <a href="add.php"><button type="submit" class="btn btn-primary">Add</button></a>
            <a href="edit.php"><button type="submit" class="btn btn-primary">Edit</button></a>
            <a href=""><button type="submit" class="btn btn-primary">Delete</button></a>

</div>

check case
<td><input type="checkbox" aria-label="Checkbox for following text input"></td>

# Préparation de la requete sql d'ajout dans phpmyadmin
SELECT `id`, `date_change`, `floor`, `position`, `power`, `brand` FROM `light-change`

## insertion de cette requête dans index.php
$sql = 'SELECT id, date_change, floor, position, power, brand FROM light-change';
"sth" veux dire "statement handle" (manipuler les instructions)
$sth = $dbh->prepare($sql);

## execution de la requete
"dbh" veux dire "database handle" (manipuler la base de données)
$sth->execute();


