<?php
session_start();
include('config.php');
include('get_droits_membre.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="fr" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="site.css" />
<title>sans titre 1</title>
</head>
<body>
<?php

if (isset($_SESSION['login']))
{
	$login = $_SESSION['login'];
	$droits_login = get_droits_membre($login);
	if ($droits_login['membres_droits_ajouter_news'] == 1) {
		echo '<a href="ajouter_news.php" target="_blank">Ajouter une news</a><br>';
	}
	if ($droits_login['membres_droits_ajouter_membre'] == 1) {
		echo '<a href="ajouter_membre.php?new=1" target="_blank">Ajouter un membre</a><br>';
	}	
	// on change le texte selon les droits
	if ($droits_login['membres_droits_controles_membre'] == 1) {
		echo '<a href="liste_membres.php" target="_blank">Liste de membres (voir/modifier)</a><br>';
	}
	else
	{
		echo '<a href="liste_membres.php" target="_blank">Liste de membres (voir seulement)</a><br>';
	}
	
	if ($droits_login['membres_droits_controles_news'] == 1) {
		echo '<a href="news.php" target="_blank">Liste des news (voir/modifier)</a><br>';
	}
	else
	{
		echo '<a href="news.php" target="_blank">Liste des news (voir seulement)</a><br>';
	}
	if ($droits_login['membres_droits_config'] == 1) {
		echo '<a href="upload_logo.php" target="_blank">Ajouter, supprimer ou modifier un logo</a><br>';
		echo '<a href="configurer_site.php" target="_blank">Configurer les options du site</a><br>';
	}
}

include('pub_logos.php');

afficher_pub();

?>
</body>