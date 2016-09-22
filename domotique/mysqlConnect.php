<?php
header('Content-type: text/html; charset=UTF-8');
$user = "root";
$password = "123soleil";
$server = "localhost";
$database = "domotique";
try {
    $connexion = new PDO("mysql:dbname=$database;host=$server", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND =>
        'SET NAMES utf8', PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"));
} catch (PDOException $e) {
    echo "Connexion échoué: " . $e->getMessage();
    exit();
}

function executeRequest($requete)
{
    global $connexion;
    $exec = $connexion->exec($requete);
    if ($exec === false) {
        echo "Erreur de requete! " . print_r($connexion->errorInfo(), true);
        exit();
    }
}
