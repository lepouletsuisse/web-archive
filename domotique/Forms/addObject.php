<?php
include "../mysqlConnect.php";
global $connexion;

$requestPiece = $connexion->query("SELECT id, nom from piece");
$requestPiece->setFetchMode(PDO::FETCH_OBJ);

$tabPiece = array();

while ($resultat = $requestPiece->fetch()) {
    $tabPiece[$resultat->id] = $resultat->nom;
}

echo '<h2>Ajouter des objets dans la maison</h2>
<form id="addObject">
    <ul>
        <li><h3>Objet à ajouter</h3>
            <ul>
                <li>
                    Nom:<br>
                    <input name = "nom" type="text" id="nom">
                </li>
                <li>
                    Type d\'objet</br>
                    <select name = "type" id="type">
                        <option value=0>Utilisable</option>
                        <option value=1>Passif</option>
                    </select>
                </li>
                <li>
                    Date d\'aquisition:<br>
                    <input name = "date" type="date" id="date">
                </li>
            </ul>
        </li>

        <li><h3>Rôle dans la maison</h3>
            <ul>
                <li>
                    Piece:<br>
                    <select name = "piece" id="piece">
                        <option value="">—</option>
		    ';
		foreach ($tabPiece as $key => $val) {
		    echo "<option value = '$key'>$val</option>";
		};

		echo '</select>
		</li><li>
			Nom de la consommation:</br>
			<input name = "nomConsommation" type="text" id="nomConsommation">
		</li><li>
			Quantité de la consommation:</br>
			<input name = "quantiteConsommation" type="number" id="quantiteConsommation">
		</li>
	</ul></li>

	<li>
		<button type="button" onclick="sendForm();" value="Envoyer">Envoyer</button>
		<div id="error"></div>
	</li>
</ul>
</form>';