<?php
session_start();
include('config.php');
include('trad_date.php');
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

if ((ISSET($_SESSION['login'])))
{
	$login = $_SESSION['login'];
	$login = mysql_real_escape_string($_SESSION['login']);
	$is_allowed = mysql_query("SELECT membres_droits_controles_membre FROM membres WHERE login='" . $login . "'") or die(mysql_error());
	$is_allowed = mysql_fetch_array($is_allowed);
	$is_allowed = $is_allowed['membres_droits_controles_membre'];
}

if ( ISSET($_GET['onglet']) )
{
	$onglet = mysql_real_escape_string($_GET['onglet']);
}
else
{
	$onglet = "profil";
}

// on get le pseudo pour lequel on affiche le profil
if ( ISSET($_GET['pseudo']) )
{
	$pseudo = mysql_real_escape_string($_GET['pseudo']);
}

// on update les droits si l'utilisateur a cliqué sur submit

if ($is_allowed == 1)
{
	if ( ISSET($_POST['droits']) )
	{
		$tableau_cases = $_POST['droits'];
		mysql_query("UPDATE membres set membres_droits_ajouter_membre = 0, membres_droits_ajouter_news = 0, membres_droits_controles_membre = 0, membres_droits_controles_news = 0 WHERE login='" . $pseudo . "'") or die(mysql_error());
		foreach($tableau_cases AS $valeur) 
		{ 
			mysql_query("UPDATE membres set " . $valeur . " = 1 WHERE login='" . $pseudo . "'") or die(mysql_error());
		}
	}
}


// infos membre profil

	// requete infos profil
	
$req = mysql_query("SELECT membres_nom, membres_prenom, membres_dt FROM membres WHERE login='" . $pseudo . "'") or die(mysql_error());
$req = mysql_fetch_array($req);

	// requete infos droits
	
$req2 = mysql_query("SELECT membres_droits_ajouter_membre, membres_droits_ajouter_news, membres_droits_controles_membre, membres_droits_controles_news FROM membres WHERE login='" . $pseudo . "'") or die(mysql_error());
$req2 = mysql_fetch_array($req2);

	// variable
	
$nom = $req['membres_nom'];
$prenom = $req['membres_prenom'];
$dt = $req['membres_dt'];
$dt = returnFrenchDate($dt);
$ajouter_membre = $req2['membres_droits_ajouter_membre'];
$ajouter_news = $req2['membres_droits_ajouter_news'];
$controles_membre = $req2['membres_droits_controles_membre'];
$controles_new = $req2['membres_droits_controles_news'];



if ($onglet == 'profil')
{
	echo '<div id="profil">
	<div id="head_profil">
	<b><div id="onglet_profil">Profil</div></b>';
	// on affiche l'onglet droits que si la personne a le droit de modification
	if ($is_allowed == 1) 
	{
		echo '<div id="onglet_profil"><a href="profil_membre.php?pseudo=' . $pseudo . '&onglet=droits">Droits</a></div>';
	}
	// on reprend
	echo '</div>
	<div id="sub_profil">Infos personnelles</div>';
	echo '<div id="cellule_profil">' . $nom . '</div>';
	echo '<div id="cellule_profil">' . $prenom . '</div>';
	echo '<div id="cellule_profil">' . $dt . '</div>';
}
elseif (($onglet == 'droits') && ($is_allowed == 1))
{
	echo '<div id="profil">
	<div id="head_profil">
	<b><div id="onglet_profil"><a href="profil_membre.php?pseudo=' . $pseudo . '&onglet=profil">Profil</a></div></b><div id="onglet_profil"><b>Droits</b></div>
	</div>
	<div id="sub_profil">Droits</div>';
	echo '<form action="profil_membre.php" method="post"> ';
	// on fait des if pour savoir si on précoche la case (qui indique quels droits sont deja activé)
	
	if ($req2['membres_droits_ajouter_membre'] == 1)
	{
		echo '<div id="cellule_profil"><input name="droits[]" type="checkbox" value="membres_droits_ajouter_membre" checked/>Ajouter un membre</div>';
	}
	else
	{
		echo '<div id="cellule_profil"><input name="droits[]" type="checkbox" value="membres_droits_ajouter_membre"/>Ajouter un membre</div>';
	}
	
	if ($req2['membres_droits_ajouter_news'] == 1)
	{
		echo '<div id="cellule_profil"><input name="droits[]" type="checkbox" value="membres_droits_ajouter_news" checked/>Ajouter une news</div>';
	}
	else
	{
		echo '<div id="cellule_profil"><input name="droits[]" type="checkbox" value="membres_droits_ajouter_news"/>Ajouter une news</div>';
	}
	
	if ($req2['membres_droits_controles_membre'] == 1)
	{
		echo '<div id="cellule_profil"><input name="droits[]" type="checkbox" value="membres_droits_controles_membre" checked/>Modifier un membre</div>';
	}
	else
	{
		echo '<div id="cellule_profil"><input name="droits[]" type="checkbox" value="membres_droits_controles_membre"/>Modifier un membre</div>';
	}
	
	if ($req2['membres_droits_controles_news'] == 1)
	{
		echo '<div id="cellule_profil"><input name="droits[]" type="checkbox" " value="membres_droits_controles_news" checked/>Modifier une news</div>'; 
	}
	else
	{
		echo '<div id="cellule_profil"><input name="droits[]" type="checkbox" " value="membres_droits_controles_news"/>Modifier une news</div>'; 
	}

    echo '<input name="onglet" type="hidden" value="profil">';
    echo '<input name="pseudo" type="hidden" value="' . $pseudo . '">';
	echo '<input type="submit">';
    echo '</form>';
	
}
?>

 </body>