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
                        <td scope="col" type="checkbox">check</td>
                        <td scope="col">#</td>
                        <td scope="col">Date change</td>
                        <td scope="col">Floor</td>
                        <td scope="col">Location</td>
                        <td scope="col">Power</td>
                        <td scope="col">Brand</td>
                    </tr>
            

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

## Récupérer le résultat de la requête
$result =$sth->fetchAll(PDO::FETCH_ASSOC);

## Insérer une condition si le tableau est vide en dessous de <table>
// Si le nombre d'élément dans le tableau
// Alors tableau vide - donc pas d'enregistrement
    if( count($result) === 0){
        echo '<p>no work</p>';
    }

## Gestion de la date au format français à mettre après le result
// French date format management
    $intlDateFormater = new IntlDateFormatter('fr_fr', IntlDateFormatter::SHORT, IntlDateFormatter::NONE);
### Modifier la ligne de la date dans le echo
echo '<td>'.$intlDateFormater->format(strtotime($row['date_change'])).'</td>';

## Dans la page add.php initialiser les variables
//  Initialisation des variables
    $date_change = '';
    $floor = '';
    $position = '';
    $power = '';
    $brand = '';
    $error = false;

### Vérififer si on reçoit le formulaire
"trim" enleve les espaces avant et après les chaines de caractères
"strlen" calcul la longueur d'une chaine de caractères

if count($_POST) > 0{
        // date_change
        if (strlen(trim($_POST['date_change']))!== 0){
            $date_change = trim($_POST['date_change']);
        }
        else{
            $error = true;
        }
        // floor
        if (strlen(trim($_POST['floor']))!== 0){
            $date_change = trim($_POST['floor']);
        }
        else{
            $error = true;
        }
        // position
        if (strlen(trim($_POST['position']))!== 0){
            $date_change = trim($_POST['position']);
        }
        else{
            $error = true;
        }
        // power
        if (strlen(trim($_POST['power']))!== 0){
            $date_change = trim($_POST['power']);
        }
        else{
            $error = true;
        }
        // brand
        if (strlen(trim($_POST['brand']))!== 0){
            $date_change = trim($_POST['brand']);
        }
        else{
            $error = true;
        }

        // si pas d'erreur on insère dans la base de données avec des marqueurs
        if( $error === false){
            $sql = "INSERT into light_change(date_change, floor, position, power, brand) VALUES(:date_change, :floor, :position, :power, :brand)";
        }
