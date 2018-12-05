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
}
$droits_login = get_droits_membre($login);

if ($droits_login['membres_droits_ajouter_news'] == 1) 
{
	function afficher_formulaire()
	{
		echo '
			<form method="post" name="form" action="ajouter_news.php">
			<table cellSpacing="0" height="50px" border="1" bordercolor="navy" width="550" align="center">
			<tr><td align="center"><u>Titre :</u><br></tr>
			<tr><td align="center"><input name="titre" value="" size="55" maxlength="120" style="width: 425px"></td></tr>
			<tr><td align="center"><u>Votre texte :</u><br><textarea name="texte" rows="10" cols="50"></textarea></td></tr>
			<tr><td align="center" colspan="2"><input type="submit" name="Submit" value="Envoyer votre news"></td></tr>
			</table>
			</form>
			';
	}

	if ((ISSET($_SESSION['login'])))
	{
		if ( (EMPTY($_POST['titre'])) && (EMPTY($_POST['texte'])) )
		{
			afficher_formulaire();
		}
		elseif ( (!EMPTY($_POST['titre'])) && (!EMPTY($_POST['texte'])) )
		{
			$titre = htmlspecialchars($_POST['titre']);
			$texte = htmlspecialchars($_POST['texte']);
			$login = $_SESSION['login'];
			
			mysql_query("INSERT INTO news (news_titre, news_contenu, news_auteur, news_dt)
			VALUES('$titre', '$texte', '$login', NOW())") or die(mysql_error());
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