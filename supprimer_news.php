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

$newsid = $_GET['news'];
$login = $_SESSION['login'];
$droits_login = get_droits_membre($login);

function redirect()
{
	echo '<SCRIPT LANGUAGE="JavaScript">
	window.opener.location.reload();
	</script>';
}

if (!ISSET($_POST['submit']))
{
	echo 'Êtes vous sur de vouloir supprimer cette news ?';
	echo '<form method="post" name="form" action="supprimer_news.php">
		<tr><td align="center" colspan="2"><input type="submit" name="submit" value="oui"></td></tr>
		<tr><td align="center" colspan="2"><input type="submit" name="submit" value="non"></td></tr>
		<input name="news" type="hidden" value="'.$newsid.'"/>
		</form>';
}
elseif ($_POST['submit'] == "oui")
{
	$auteur = mysql_query('SELECT news_auteur FROM news WHERE news_id="'.$_POST['news'].'"') or die(mysql_error());
	$auteur = mysql_fetch_assoc($auteur);
	$auteur = $auteur['news_auteur'];
	
	if ($login == $auteur)
	{
		$access = 1;
	}
	
	if (( $droits_login['membres_droits_controles_news'] == 1) || ($access == 1))
	{
		mysql_query('DELETE FROM news WHERE news_id="'.$_POST['news'].'"') or die(mysql_error());
		echo 'La news a été supprimée avec succès.';
		redirect();
	}
	else
	{
		echo 'non autorisé';
		redirect();
	}
}
elseif ($_POST['submit'] == "non")
{
	echo 'Aucune modification n\'a été apportée.';
	redirect();
}


?>
<br>
<a href="javascript: void(0);" onclick="window.close()">Fermer</a>
</body>