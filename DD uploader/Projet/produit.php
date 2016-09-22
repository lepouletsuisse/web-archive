<?php
header('Content-Type: text/plain; charset=utf-8');
$con=mysql_connect("localhost","root","samy1994");
if(!$con){
	die('Connection impossible! RAISON: '.mysql_error());
}
mysql_select_db("school",$con);
$result=mysql_query("select * from Produit");
//$row0=mysql_fetch_array($result);
//$taille_final=($row0['Taille'])/10000;
while ($row=mysql_fetch_array($result)){
echo "</br><table border=\"1\"><td><tr align=\"center\" valign=\"middle\">Nom: ".$row['Nom']."</br>Type: ".$row['Type']."</br>Taille: ".$row['Taille']."</br>Date d'ajout: ".$row['Date_ajout']."</tr><tr align=\"center\" valign=\"middle\"><button onClick=\"window.location='http://178.198.247.24/Projet/mesfichiers/DD/".$row['Nom']."'\">Télécharger le fichier ".$row['Nom']."</button></tr></td></table></br>"; 
}
mysql_close($con);
?>