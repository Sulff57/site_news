<?php 

						
$bdd = mysql_connect("localhost", "Julien", "p3wasbom"); 
/* on se connecte à mysql sur le serveur lui-même ("localhost"), avec ses identifiants d'accès (login "Julien", password "p3wasbom") */

if (!$bdd) /* si la variable n'existe pas (connexion échouée), */

{
	die('Echec de la connexion : ' . mysql_error()); /* on affiche l'erreur */
}
	
$db = mysql_select_db("siteJulien", $bdd);
/* on sélectionne la base de donnée du site */
if (!$db)
{
	die('Impossible d\'utiliser la base : ' . mysql_error());
}
?>