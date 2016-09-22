<?php

include "../mysqlConnect.php";
include "../class.php";
global $connexion;
$request = $connexion->query("SELECT * from maison Inner join adresse on maison.adresse_id = adresse.id");
$request->setFetchMode(PDO::FETCH_OBJ);
echo "<h2>La maison</h2>";
echo "<ul id='maison'>";
while ($resultat = $request->fetch()) {
    echo "<li><b>$resultat->rue, $resultat->numero <br/>" .
 	     "$resultat->npa, $resultat->ville</b></li>" .
         "<li><b>$resultat->nb_personne membres</b> de la <b>famille $resultat->nom_famille</b> se partagent les <b>$resultat->nb_piece pièces</b> de la maison.</li>";
}
echo "</ul>";


$connexion = null;