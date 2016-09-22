<?php
include "../mysqlConnect.php";

$requestPiece = $connexion->query("SELECT id, nom from piece");
$requestPiece->setFetchMode(PDO::FETCH_OBJ);

$tabPiece = array();

while ($resultat = $requestPiece->fetch()) {
    $tabPiece[$resultat->id] = $resultat->nom;
}
echo "<h2>Ajouter un capteur</h2>";
echo '
<form id="addCapteur">
    Piece:<br>
    <select name = "piece" id="piece">
        <option value=""></option>
    ';
foreach ($tabPiece as $key => $val) {
    echo "<option value = '$key'>$val</option>";
};

echo '</select></br>
    Type:<br>
    <select name = "type" id="type">
        <option value="anemometre">Anemometre</option>
        <option value="luxmetre">Luxmetre</option>
        <option value="presence">Capteur de présence</option>
        <option value="thermometre">Thermomètre</option>
        </select></br>
    <button type="button" onclick="sendForm(\'addUser\');" value="Envoyer">Envoyer</button>
    <div id="error"></div>
</form>';