<?php
header('Content-Type: text/plain; charset=utf-8');
$nom_objet=$_POST['nom_objet'];
$id_objet=$_POST['id_objet'];
$con=mysql_connect("localhost","root","samy1994");
if(!$con){
	die('Connection impossible! RAISON: '.mysql_error());
}
mysql_select_db("school",$con);
$produit = "SELECT * FROM Produit WHERE (Nom='$nom_objet' or ID='$id_objet')";
$produit1=mysql_query($produit) or die ('Erreur SQL !'.$produit.'<br>'.mysql_error());
$produit_id=mysql_fetch_array($produit1);
$produit_nom=$produit_id['Nom'];
//Verifie si notre element existe bien dans une BDD
$verif = "SELECT Nom FROM Produit WHERE Nom='$nom_objet'";
$verif1 = "SELECT ID FROM Produit WHERE ID='$id_objet'";
$req_verif = mysql_query($verif) or die('Erreur SQL !'.$verif.'<br>'.mysql_error());
$req_verif1 = mysql_query($verif1) or die('Erreur SQL !'.$verif1.'<br>'.mysql_error()); 
$res_verif = mysql_num_rows($req_verif);
$res_verif1 = mysql_num_rows($req_verif1);
if($res_verif==0 && $res_verif1==0){
    echo "<font color='red'>Desole, mais ce fichier n'existe pas, vérifier que vous n'avez pas fait de faute de frappe.</font>";
}
else{
	echo "<font color='green'>Le fichier a bien été séléctionner, cliquer sur le lien suivant afin de télécharger votre fichier:</font> <a href='http://178.198.247.24/Projet/mesfichiers/DD/$produit_nom'>Votre fichier à télécharger</a>";
}
mysql_close($con);
?>