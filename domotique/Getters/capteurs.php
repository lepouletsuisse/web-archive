<?php

include "../mysqlConnect.php";
include "../class.php";
global $connexion;
$requestThermometre = $connexion->query("SELECT * from view_thermometreData");
$requestLuxmetre = $connexion->query("SELECT * from view_luxmetreData");
$requestAnemometre = $connexion->query("SELECT * from view_anemometreData");
$requestPresence = $connexion->query("SELECT * from view_presenceData");


$requestThermometre->setFetchMode(PDO::FETCH_OBJ);
$requestLuxmetre->setFetchMode(PDO::FETCH_OBJ);
$requestAnemometre->setFetchMode(PDO::FETCH_OBJ);
$requestPresence->setFetchMode(PDO::FETCH_OBJ);

echo "<h2>Liste des thermomètres</h2>";

while ($resultat = $requestThermometre->fetch()) {
    echo "</br>Id capteur: $resultat->id_capteur</br>" .
        "Piece: $resultat->Piece</br>" .
        "Degres: $resultat->Degres</br>";
}

echo "<h2>Liste des luxmètres</h2>";

while ($resultat = $requestLuxmetre->fetch()) {
    echo "</br>Id capteur: $resultat->id_capteur</br>" .
        "Piece: $resultat->Piece</br>" .
        "Lux: $resultat->Lux</br>";
}

echo "<h2>Liste des anemomètres</h2>";

while ($resultat = $requestAnemometre->fetch()) {
    echo "</br>Id capteur: $resultat->id_capteur</br>" .
        "Piece: $resultat->Piece</br>" .
        "Vitesse du vent: $resultat->VitesseVent</br>";
}

echo "<h2>Liste des capteurs de présence</h2>";
while ($resultat = $requestPresence->fetch()) {
    echo "</br>Id capteur: $resultat->id_capteur</br>" .
        "Piece: $resultat->Piece</br>" .
        "Nombre de personne: $resultat->NbPersonne</br>";
}
$connexion = null;