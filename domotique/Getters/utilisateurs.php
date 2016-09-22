<?php
include "../mysqlConnect.php";
include "../class.php";
global $connexion;
$request = $connexion->query("SELECT * from view_utilisateurAdresse");
$request->setFetchMode(PDO::FETCH_OBJ);
echo "<h2>Liste des utilisateurs</h2>";
echo "<ul id='utilisateurs'>";
$utilisateurs = array();
while ($resultat = $request->fetch()) {
    if (array_key_exists($resultat->id_utilisateur, $utilisateurs)) {
        if (array_search($resultat->Nom, $utilisateurs[$resultat->id_utilisateur]->nom) === false) {
            array_push($utilisateurs[$resultat->id_utilisateur]->nom, $resultat->Nom);

        }
        else if (array_search($resultat->Prenom, $utilisateurs[$resultat->id_utilisateur]->prenom) === false) {
            array_push($utilisateurs[$resultat->id_utilisateur]->prenom, $resultat->Prenom);
        }
    } else {
        $utilisateurs[$resultat->id_utilisateur] = new Utilisateur($resultat->id_utilisateur,
            $resultat->Nom, $resultat->Prenom, $resultat->Naissance, $resultat->Ville, $resultat->NPA,
            $resultat->Rue, $resultat->Numero);
    }
}

echo implode("", $utilisateurs);

echo "</ul>";
$connexion = null;