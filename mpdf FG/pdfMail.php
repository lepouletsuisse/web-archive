<?php


/*
 * Use the mPdf PHP library for creating the PDF and sending the mail
 * */
include("mpdf/mpdf.php");

$mpdf = new mPDF();

$nom = "dummy";
$prenom = "player";

//Use a buffer
ob_start();

//Echo tout ce dont on a besoin dans le PDF!

echo file_get_contents("mailFG.tpl");

$buffer = ob_get_contents();
ob_end_clean();

//Convert the buffer to HTML in UTF-8
$mpdf->WriteHTML($buffer);

$content = $mpdf->Output('', 'S');

$content = chunk_split(base64_encode($content));

//Addresse du participant
$mailto = "dummyPlayer@gmail.com";
$from_name = "FestiGeek";
//Addresse de Festigeek
$from_mail = "info@festigeek.ch";
//Sujet du mail
$subject = "[Important] Vos informations personelle pour FestiGeek";
//Le message en HTML
$message = "<div>Bonjour,<br>c'est tous bientôt Festigeek et il est grand temps de se préparer à venir!<br><br>
Voici donc quelque informations afin de vous aider.</div>";
$filename = $prenom.'_'.$nom.'_information';

//Header of PDF and E-Mail
$boundary = "XYZ-".date(dmYis)."-ZYX";


$header = "--$boundary\r\n";
$header .= "Content-Transfer-Encoding: 8bits\r\n";
$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n\r\n";
$header .= "$message\r\n";
$header .= "--$boundary\r\n";
$header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n";
$header .= "Content-Disposition: attachment; name=\"".$filename."\"\r\n";
$header .= "Content-Transfer-Encoding: base64\r\n\r\n";
$header .= "$content\r\n";
$header .= "--$boundary--\r\n";

$header2 = "MIME-Version: 1.0\r\n";
$header2 .= "From: ".$from_name." \r\n";
$header2 .= "Return-Path: $from_mail\r\n";
$header2 .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
$header2 .= "$boundary\r\n";

//Envoie du mail
//mail($mailto, $subject, $header, $header2, "-r".$from_mail);

//$mpdf->Output($filename.".pdf", 'F');
$mpdf->Output($filename.".pdf", 'F');

exit;