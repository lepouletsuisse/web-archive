<?php

include "../mysqlConnect.php";

global $connexion;

$nom = $_POST['nom'];

executeRequest('INSERT INTO etat(nom) VALUES("'.$nom.'")');

echo "</br>L'etat suivant a été ajouté:</br>" .
    "</br>Etat: $nom</br>";


