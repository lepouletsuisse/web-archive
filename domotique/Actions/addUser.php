<?php

include "../mysqlConnect.php";

global $connexion;

$Nom = $_POST['nom'];
$Prenom = $_POST['prenom'];
$Sexe = strtoupper($_POST['sexe']);
$Avs = $_POST['avs'];
$Type = $_POST['type'];
$Naissance = $_POST['naissance'];
$Ville = $_POST['ville'];
$Npa = $_POST['npa'];
$Rue = $_POST['rue'];
$Numero = $_POST['numero'];

$Naissance = substr($Naissance, 0, 4) . "-" . substr($Naissance, 5, 2) . "-" . substr($Naissance, 8, 2);

executeRequest('INSERT INTO utilisateur(sexe, avs, naissance) VALUES ("' . $Sexe . '","' . $Avs . '","' . $Naissance . '")');
$UtilisateurId = $connexion->lastInsertId();

executeRequest('INSERT INTO utilisateur_nom(utilisateur_id, nom) VALUES ("' . $UtilisateurId . '","' . $Nom . '")');
executeRequest('INSERT INTO utilisateur_prenom(utilisateur_id, prenom) VALUES ("' . $UtilisateurId . '","' . $Prenom . '")');
$adressesRaw = $connexion->query('SELECT * FROM adresse WHERE ville = "' . $Ville . '" AND npa = "' . $Npa . '" AND rue =
    "' . $Rue . '" AND numero = "' . $Numero . '"');
$adressesRaw->setFetchMode(PDO::FETCH_OBJ);

$AdresseId;
if ($adressesRaw->rowCount() == 0) {
    executeRequest('INSERT INTO adresse(ville, npa, rue, numero) VALUES ("' . $Ville . '","' . $Npa . '","' . $Rue
        . '","' . $Numero . '")');
    $AdresseId = $connexion->lastInsertId();
    echo "</br>L'adresse suivante n'existait pas dans la base de donnée. Elle a été ajouté.";
} else {
    $resultat = $adressesRaw->fetch();
    $AdresseId = $resultat->id;
    echo "</br>L'adresse suivante existait déjà dans la base de donnée. Elle n'a pas été rajouté.";
}

echo "</br>
    Ville: $Ville</br>
    NPA: $Npa</br>
    Rue: $Rue</br>
    Numéro: $Numero</br>";

switch ($Type) {
    case 0: //Parent
        executeRequest('INSERT INTO parent(utilisateur_id, adresse_job_id) VALUES ("' . $UtilisateurId . '","' . $AdresseId . '")');
        break;
    case 1: //Enfant
        executeRequest('INSERT INTO enfant(utilisateur_id, adresse_ecole_id) VALUES ("' . $UtilisateurId . '","' . $AdresseId . '")');
        break;
    case 2: //Visiteurs
        executeRequest('INSERT INTO visiteur(utilisateur_id, adresse_id) VALUES ("' . $UtilisateurId . '","' . $AdresseId . '")');
        break;
    case 3; //Proprietaire
        executeRequest('INSERT INTO proprietaire(utilisateur_id, adresse_id) VALUES ("' . $UtilisateurId . '","' . $AdresseId . '")');
        break;
    default:
        ob_clean();
        echo "</br>Le type n'est pas valide! Veuillez recommencez!</br>";
        exit();
}


echo "</br>L'utilisateur suivant a bien été ajouté:</br>
    Nom: $Nom</br>
    Prenom: $Prenom</br>
    Sexe: $Sexe</br>
    AVS: $Avs</br>
    Type: $Type</br>
    Date de naissance: $Naissance</br>";