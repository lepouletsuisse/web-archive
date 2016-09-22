<?php
include "../mysqlConnect.php";
include "../class.php";
global $connexion;

$request = $connexion->query("SELECT * from adresse");
$request->setFetchMode(PDO::FETCH_OBJ);
echo "<h2>Liste des adresses stocké</h2>";
echo "<ul id='adresses'>";

while ($resultat = $request->fetch()) {
    echo "<li><h3>Adresse $resultat->id</h3><ul>" .
    	 "<li>$resultat->rue, $resultat->numero <br/> $resultat->npa, $resultat->ville</li></ul></li>";
}
echo "</ul>";

$connexion = null;