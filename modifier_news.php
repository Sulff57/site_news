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

function get_auteur($newid)
{
	if (isset($_SESSION['login']))
	{
		$login = $_SESSION['login'];
	}
	$droits_login = get_droits_membre($login);

	$auteur = mysql_query('SELECT news_auteur FROM news WHERE news_id="'.$newid.'"') or die(mysql_error());
	$auteur = mysql_fetch_assoc($auteur);
	$auteur = $auteur['news_auteur'];

	return $auteur;
}

if (ISSET($_GET['news']))
{
	$auteur = get_auteur($_GET['news']);
}
else
{
	$auteur = get_auteur($_POST['news']);
}
	
if ($login == $auteur)
{
	$access = 1;
}

if (( $droits_login['membres_droits_controles_news'] == 1) || ($access == 1))
{ 
	if ( isset($_GET['news']) || isset($_POST['news']) )
	{


		function afficher_formulaire()
		{
			$req = mysql_query('SELECT news_titre, news_contenu FROM news WHERE news_id="' . $_GET['news'] . '"') or die(mysql_error());
			$req = mysql_fetch_assoc($req);
			$titre = $req['news_titre'];
			$contenu = $req['news_contenu'];
			$newsid = $_GET['news'];
			echo '
				<form method="post" name="form" action="modifier_news.php">
				<table cellSpacing="0" height="50px" border="1" bordercolor="navy" width="550" align="center">
				<tr><td align="center"><u>Titre :</u><br></tr>
				<tr><td align="center"><input name="titre" value="'.$titre.'" resize="55" maxlength="120" style="width: 425px"/></td></tr>
				<tr><td align="center"><u>Votre texte :</u><br><textarea name="texte" rows="10" cols="50"/>'.$contenu.'</textarea></td></tr>
				<input name="news" type="hidden" value="'.$newsid.'"/>
				<tr><td align="center" colspan="2"><input type="submit" name="Submit" value="Envoyer votre news"></td></tr>
				</table>
				</form>
				';
		}
		if ( (EMPTY($_POST['titre'])) && (EMPTY($_POST['texte'])) )
		{
			afficher_formulaire();
		}
		elseif ( (!EMPTY($_POST['titre'])) && (!EMPTY($_POST['texte'])) )
		{
			$titre = htmlspecialchars($_POST['titre']);
			$texte = htmlspecialchars($_POST['texte']);
			$login = $_SESSION['login'];
			mysql_query("UPDATE news set news_titre = '" . $titre . "', news_contenu = '" . $texte . "', news_dt = NOW() WHERE news_id = '" . $_POST['news'] . "'") or die(mysql_error());
			echo '<script language="javascript" type="text/javascript">
				<!--
				window.location.replace("./news.php");
				-->
				</script>';
		}
		else 
		{
			echo '<center><color=red>Vous avez omis de remplir un ou plusieurs champs. Veuillez recommencer :</color></center><br><br>';
			afficher_formulaire();
		}
	}
}


?>


 </body>