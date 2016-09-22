<?php
$con=mysql_connect("localhost","root","samy1994");
mysql_select_db("school",$con);	
if(!$con){
	die('Connection impossible! RAISON: '.mysql_error());
}	

$nf = htmlspecialchars($_POST['nom_fichier']);
if($nf==""){
	echo json_encode(array("error" => "Le nom de fichier n'est pas spécifié! Veuillez réessayer."));
	}
else{
	$nomOrigine = $_FILES['monfichier']['name'];
	$elementsChemin = pathinfo($nomOrigine);
	$extensionFichier=$elementsChemin['extension'];
	$nf1=$nf.".".$extensionFichier;
	$taille = $_FILES['monfichier']['size'];
	$extensionsAutorisees = array("jpeg", "jpg", "gif", "odt", "avi", "mpg", "mp3","png","pdf","doc","docx","mp4","pptx","zip","rar","7z","flv");
	if (!(in_array($extensionFichier, $extensionsAutorisees))) {
    	echo json_encode(array("error" => "Le fichier n'a pas une extension valide! Le fichier n'a pas été enregistré. Veuillez réessayer l'opération avec un autre type de fichier."));
	} else {    
  	  $repertoireDestination = dirname(__FILE__)."/mesfichiers/DD/";
  	  if (move_uploaded_file($_FILES["monfichier"]["tmp_name"],
  	                                   $repertoireDestination.$nf1)) {
  	        
  	        		
  	        mysql_query("insert into Produit set ID='0',Nom='".$nf1."',Type='".$extensionFichier."',Taille='".$taille."';");
  	        $produit_id0 = mysql_query("SELECT ID FROM Produit WHERE Nom='$nf1'") or die ('Erreur SQL !'.$produit.'<br>'.mysql_error());
			$produit_id=mysql_fetch_array($produit_id0);
    	    echo json_encode(array("success" => "Le fichier à bien été déplacé sur le serveur. Merci de l'avoir partagé!"));
    } else {
      	  echo json_encode(array("error" => "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                "le déplacement du fichier temporaire a échoué."));
			}
   		}
	}
?>