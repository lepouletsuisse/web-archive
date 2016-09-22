<?php

include "../mysqlConnect.php";

global $connexion;

$piece = $_POST['piece'];
$nom = $_POST['nom'];
$date = $_POST['date'];
$type = $_POST['type'];
$nomConsommation = $_POST['nomConsommation'];
$quantiteConsommation = $_POST['quantiteConsommation'];

$date = substr($date, 0, 4) . "-" . substr($date, 5, 2) . "-" . substr($date, 8, 2);

executeRequest('INSERT INTO objet(piece_id, etat_id, nom, date_aquisition) VALUES(' . $piece . ',1, "' . $nom . '", "' . $date . '")');
$objetId = $connexion->lastInsertId();

if ($type == 0) {
    executeRequest('INSERT INTO objet_utilisable(objet_id) VALUES(' . $objetId . ')');
} else {
    executeRequest('INSERT INTO objet_passif(objet_id) VALUES(' . $objetId . ')');
}
executeRequest('INSERT INTO consommation(objet_id, nom, quantite) VALUES(' . $objetId . ',"' . $nomConsommation . '", ' . $quantiteConsommation . ')');


echo "</br>L'objet suivant a été ajouté:</br>" .
    "</br>Piece: $piece" .
    "</br>Nom: $nom" .
    "</br>Date: $date" .
    "</br>Type: " . ($type ? "Passif" : "Utilisable") .
    "</br>Nom de la consommation: $nomConsommation" .
    "</br>Quantité de la consommation: $quantiteConsommation";


