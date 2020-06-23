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