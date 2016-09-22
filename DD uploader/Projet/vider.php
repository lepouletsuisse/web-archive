<?php
header('Content-Type: text/plain; charset=utf-8');
$table=$_POST['table'];
$con=mysql_connect("localhost","root","samy1994");
mysql_select_db("school",$con);
if($table=='Utilisateur'){
	$sql="TRUNCATE TABLE Utilisateur";
	mysql_query($sql) or die("Erreur SQL! ".mysql_error());
	echo "Les données de la table Utilisateur ont bien été supprimées.";
}
if($table=='Acheter'){
	$sql="TRUNCATE TABLE Acheter";
	mysql_query($sql) or die("Erreur SQL! ".mysql_error());
	echo "Les données de la table Acheter ont bien été supprimées.";
}
if($table=='Deux'){
	$sql="TRUNCATE TABLE Utilisateur";
	$sql1="TRUNCATE TABLE Acheter";
	mysql_query($sql) or die("Erreur SQL! ".mysql_error());
	mysql_query($sql1) or die("Erreur SQL! ".mysql_error());
	echo "Les données des tables Utilisateur et Acheter ont bien été supprimées.";
}
mysql_close($con);
?>