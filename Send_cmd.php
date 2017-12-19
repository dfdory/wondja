<?php
ob_start();
session_start(); 
$debut =$_POST["txtFromDate"];
$fin =$_POST["txtToDate"];
$qte =$_POST["nbre"];
$nom=addslashes($_POST["nom"]);
$prenom=addslashes($_POST["prenom"]);
$sujet="Wondja: Nouvelle commande";
$email=addslashes($_POST["email"]);
$tel=addslashes($_POST["tel"]);
$pays=addslashes($_POST["pays"]);
//$message=addslashes($_POST["message"]);
$mail="carolekouam@gmail.com";

                //------------------Debut  mail---------------
if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) 
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}
//=====Declaration des messages au format texte et au format HTML
$message_txt  = 'Nouvelle Commande du pack \n Informations\n\n Nom: $nom $prenom\n Email: $email \n Tel: $tel\n pays de residence: $pays\n periode: Du $debut au $fin ';
$message_html = '<div style="text-align:justify;" >
	<p> Nouvelle commande du pack</p>
	<p>&nbsp;</p>
	<p>Informations</p>
	<p>Nom : <strong >$nom &nbsp; $prenom</strong></p>
	<p>Email: <strong >$email</strong></p>
	<p>Tel: <strong >$tel</strong></p>
	<p>Pays: <strong >$pays</strong></p>
	<p>p&eacute;riode :Du  <strong>$debut &nbsp;</strong> au <strong>$fin &nbsp;</strong> </p>
	
</div>';
//==========
        
//=====Creation de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Definition du sujet
$sujet = "$sujet!";
//=========
 
//=====Creation du header de l'e-mail
$header = "From: $name".$passage_ligne;
$header.= "Reply-to: no_reply".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Creation du message
$message = $passage_ligne.$boundary.$passage_ligne;
//=====Ajout du message au format texte
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========

//=====Envoi de l'e-mail
mail($mail,$sujet,$message,$header);
//-------------------Fin  mail------------------------------------------

header("Location:index.html");
?>