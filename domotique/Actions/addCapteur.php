<?php

include "../mysqlConnect.php";

global $connexion;

$piece = $_POST['piece'];
$type = $_POST['type'];

executeRequest('INSERT INTO capteur(piece_id) VALUES (' . $piece . ')');
$capteurId = $connexion->lastInsertId();

executeRequest('INSERT INTO ' . $type . ' VALUES (' . $capteurId . ',0)');

echo "</br>Le capteur suivant a bien été ajouté:</br>
    Type: $type</br>
    Piece: $piece</br>";