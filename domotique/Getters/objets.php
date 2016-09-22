<?php
include "../mysqlConnect.php";
include "../class.php";
global $connexion;

$request = $connexion->query("SELECT * from view_objetEtatConsommation");
$request->setFetchMode(PDO::FETCH_OBJ);
echo "<h2>Liste des objets</h2>";
echo "<ul id='objet'>";
    while ($resultat = $request->fetch()) {
        switch ($resultat->Etat) {
            case "ON":
                $name = "GREEN";
                break;
            case "OFF":
                $name = "RED";
                break;
            case "En marche";
                $name = "ORANGE";
                break;
            default:
                $name = "GREY";
                break;
        }
        echo "<li><h3>$resultat->Objet</h3><ul>" .
            "<li><span class = '$name'>Etat: $resultat->Etat</li></span>" .
            "<li>Piece: $resultat->Piece</li>" .
            "<li>Type de consommation: $resultat->NomConsommation</li>" .
            "<li>Quantité: $resultat->QuantiteConsommation</li></ul></li>";
    }//while
echo "</ul>";

$connexion = null;