<?php
session_start(); // On démarre la session AVANT toute chose
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="fr" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="site.css" />
<title>sans titre 1</title>
</head>
<body><?php
/* tout le texte situé entre les balises <? php et ? > correspond au lagage PHP, il n'est donc pas visible normalement sous dreamwaver. */
include("config.php"); /* on va se connecter à mysql puis à la base de donnée du site en exécutant ce fichier */
						/* pratique pour ne pas avoir à éditer toutes les page php en cas de changement de login */
						/* il suffira en effet de modifier ce fichier la */
//if ( (isset($_POST['login'])) && (isset($_POST['password'])) ) 
//{
	//$login = $_POST['login'];
	//$password = $_POST['password'];
	$login = 'Admin';
	$password = 'test123';
	$requete = mysql_query("SELECT * FROM membres WHERE login='" . $login . "' AND password='" . $password . "'");
	$nb_resultats = mysql_num_rows($requete);
	if ($nb_resultats != 0)
	{
		while ($data = mysql_fetch_array($requete))
		{
			$_SESSION['login'] = $_POST['login'];
			echo '<script language="javascript" type="text/javascript">
			<!--
			window.location.replace("./interface_admin.php");
			-->
			</script>';
		}
		exit();
	}
	else
	{
	echo 'Erreur : compte non reconnu.';
	}
// }		
// else
// {
// echo '
// <div id="login">
		
	// <form action="login.php" method="post">
		// Identification<br/>
		// <input type="text" name="login" /><br/>
		// <input type="password" name="password" /><br/>
		// <input type="submit" value="valider" />
	// </form>
		
// </div>
// ';
// }
	
?> <!-- fin du php -->


</body>

</html>
