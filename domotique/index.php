<?php
header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-language" content="fr"/>
    <link rel='stylesheet' type='text/css' href='style.css'/>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed|Droid+Serif|Teko' rel='stylesheet' type='text/css'> <!-- Typographies Google Fonts -->
    <script type="text/javascript" src="jquery.js"></script>
    <script>
        $.ajax({
            type: "POST",
            url: "Getters/maison.php",
            success: function (result) {
                $("#maison").empty().append(result);
            }
        });

        function changeSelect(obj) {
            if (obj == "") {
                $("#output").empty();
            }
            $.ajax({
                type: "POST",
                url: "Getters/" + obj + ".php",
                success: function (result) {
                    $("#output").empty().append(result);
                }
            });
        }

        function askForm(obj) {
            $.ajax({
                type: "POST",
                url: "Forms/" + obj + ".php",
                success: function (result) {
                    $("#output").empty().append(result);
                }
            });
        }

        function sendForm() {
            $.ajax({
                type: "POST",
                url: "Actions/"+ $("form").attr("id") +".php",
                data: $("form").serialize(),
                success: function (result) {
                    $("#output").empty().append(result);
                }
            });
            return false;
        }
    </script>
</head>
<body>

    <div id="ciel">

        <!-- Toit (banière) -->
        <header id="toit">
            <h1>Domotique</h1>
            <h2 id="slogan">Projet de base de données</h2>
        </header>

        <!-- Crépi (contenu) -->
        <div id="crepi">

            <!-- Fenêtres (infos maison et menu) -->
            <aside class="fenetre un">
                <div id="maison"></div>
            </aside><!-- commentaire = technique anti-whitespaces pour les éléments inline-block
            --><nav class="fenetre deux">
                <h2>Le menu</h2>
                <div class="afedit un">
                    <h3>Afficher</h3>
                    <select onChange="changeSelect(this.value)">
                        <option value="">—</option>
                        <option value="utilisateurs">Utilisateurs</option>
                        <option value="adresses">Adresses</option>
                        <option value="objets">Objets</option>
                        <option value="capteurs">Capteurs</option>
                    </select>
                 </div><!-- anti-whitespace
                 --><div class="afedit deux">
                    <h3>Éditer</h3>
                    <button onclick="askForm(this.value)" value="addUser">Ajouter un utilisateur</button>
                    <button onclick="askForm(this.value)" value="addObject">Ajouter un objet</button>
                    <button onclick="askForm(this.value)" value="addEtat">Ajouter un etat</button>
                    <button onclick="askForm(this.value)" value="addCapteur">Ajouter un capteur</button>
                </div>
            </nav>
                

            <!-- Mur (affichage des informations) -->
            <article id="mur">
                <div id="output">
                    <p><em>Commencez par sélectionner une liste à afficher ci en haut à gauche.</em></p>
                </div>
            </article>

        </div><!-- crepi -->
    </div><!-- ciel -->

    <!-- Gazon (footer pour signature) -->
    <footer id="gazon">
        <p> — Christophe Peretti & Samuel Darcey, HEIG-VD, Janvier 2016.</br>Designed by Camille Rattoni</p>
    </footer>

</body>
</html>