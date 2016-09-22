<?php
include "../mysqlConnect.php";
global $connexion;

$requestEtat = $connexion->query("SELECT id, nom from etat");
$requestEtat->setFetchMode(PDO::FETCH_OBJ);

$tabEtat = array();

while ($resultat = $requestEtat->fetch()) {
    $tabEtat[$resultat->id] = $resultat->nom;
}

echo '
<h2>Modifier les états</h2>

<ul><li><h3>Etats existants</h3><ul>';
foreach ($tabEtat as $key => $val) {
    echo "<li>$key: $val</li>";
};
echo '</ul></li>';
echo '
<li><h3>Ajout d\'un nouvel état</h3><ul>
<form id="addEtat">
    <li>Nouveau nom:<br/>
    <input name = "nom" type="text" id="nom"></li>
    <li><button type="button" onclick="sendForm();" value="Envoyer">Ajouter</button>
    <div id="error"></li>
</form></ul></li></ul>';