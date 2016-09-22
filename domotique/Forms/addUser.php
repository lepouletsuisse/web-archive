<?php

echo '
<h2>Ajouter un nouvel utilisateur de la maison</h2>
<form id="addUser">
    <ul>
        <li><h3>Informations générales</h3><ul>
            <li>
                Prénom:<br>
                <input name = "prenom" type="text" id="prenom">
            </li><li>
                Nom:<br>
                <input name = "nom" type="text" id="nom">
            </li><li>
                Date de naissance:</br>
                <input name = "naissance" type="date" id="naissance">
            </li><li>
                Sexe:<br>
                <select name = "sexe" id="sexe">
                    <option value="m">Homme</option>
                    <option value="f">Femme</option>
                </select>
            </li>
        </ul></li>

        <li><h3>Adresse</h3><ul>
            <li>
                Rue:</br>
                <input name = "rue" type="text" id="rue">
            </li><li>
                Numero:</br>
                <input name = "numero" type="text" id="numero">
            </li><li>
                Ville:</br>
                <input name = "ville" type="text" id="ville">
            </li><li>
                NPA:</br>
                <input name = "npa" type="text" id="npa">
            </li>
        </ul></li>

        <li><h3>Autres</h3><ul>
            <li>
                AVS:<br>
                <input name = "avs" type="text" id="avs">
            </li><li>
                Statut:<br>
                <select name = "type" id="type">
                    <option value=0>Parent</option>
                    <option value=1>Enfant</option>
                    <option value=2>Visiteur</option>
                    <option value=3>Proprietaire</option>
                </select>
            </li>
        </ul></li>

        <li>
            <button type="button" onclick="sendForm();" value="Envoyer">Envoyer</button>
            <div id="error"></div>
        </li>
    </ul>
</form>';