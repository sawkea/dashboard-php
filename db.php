<?php
// define('DATABASE', 'soniah_dashboard');
// define('USER', 'soniah');
// define('PWD', 'mW3SxOh6/3S+gQ==');
// define('HOST', 'localhost');
// local connection
define('DATABASE', 'dashboard');
define('USER', 'root');
define('PWD', '');
define('HOST', 'localhost');
try {
    $dbh = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} 
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}