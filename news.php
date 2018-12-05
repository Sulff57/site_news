<?php
session_start();
include('config.php');
include('trad_date.php');
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


// on va déterminer le nombre de pages nécessaires pour afficher le total des news.
// pour cela on prend le nombre de news total
// qu'on divise par le nombre de news à afficher par page défini dans la config
// puis on arrondit car il peut y avoir par ex 43 news, ce qui ferait pour un ($nb_news_par_page == 10) 4 pages complete de 10 news + 3 news par exemple.

if (ISSET($_SESSION['login']))
{
	$login = ($_SESSION['login']);
}

$droits_login = get_droits_membre($login);


$requete = mysql_query('SELECT config_news_par_page FROM config WHERE config_switch LIKE 1');

while ($ligne = mysql_fetch_assoc($requete))
{
	$nb_news_par_page = $ligne['config_news_par_page'];
}


if ( ISSET($_GET['page']) )
{
	$page_actuelle = (int)$_GET['page'];
}
else
{
	$page_actuelle = 1;
}


$nb_total_news = mysql_query("SELECT COUNT(*) FROM news");
$nb_total_news = mysql_result($nb_total_news, 0); 
$nb_pages = ( $nb_total_news / $nb_news_par_page );
$nb_pages = ceil($nb_pages);

// on va calculer l'intervalle des news à afficher 

$intervalle_haut = ( $page_actuelle * $nb_news_par_page );
$intervalle_bas = ( $intervalle_haut - $nb_news_par_page );

$requete = mysql_query('SELECT news_id, news_titre, news_contenu, news_auteur, news_dt FROM news LIMIT ' . $intervalle_bas . ',' . $intervalle_haut);



while ($ligne = mysql_fetch_assoc($requete))
{

	$pseudo = $ligne['news_auteur'];
	// on prend à partir du pseudo associé à la news le nom et prenom correspondant dans la table membres
	$auteur = mysql_query('SELECT membres_nom, membres_prenom FROM membres WHERE login LIKE "' . $pseudo . '"'); 
	while($donnees=mysql_fetch_assoc($auteur))
	{
		$auteur_nom = $donnees['membres_nom'];
		$auteur_prenom = $donnees['membres_prenom'];
		
	}
	$dt = $ligne['news_dt'];
	$dt = returnFrenchDate($dt);
	echo '
		<div id="cadre_news">
		<div id="titre_news">' . $ligne['news_titre'] . '</div>
		<div id="texte_news">' . $ligne['news_contenu'] . '</div>
		<div id="auteur_news">Par ' . $auteur_prenom . ' ' . $auteur_nom . ', le ' . $dt . ' </div>';
		
	if ($droits_login['membres_droits_controles_news'] == 1)
	{
		echo '<div id="option_modifier_news"><a href="modifier_news.php?news=' . $ligne['news_id']. '">Modifier</a></div>';
		echo '<div id="option_modifier_news"><a href="supprimer_news.php?news=' . $ligne['news_id']. '" target="_blank">Supprimer</a></div>';
	}
	else
	{
		if (ISSET($_SESSION['login']))
		{
			// si la personne logguée est celle qui a posté la news on lui accorde quand meme le contrôle
			if ($pseudo == $login)
			{
				echo '<div id="option_modifier_news"><a href="modifier_news.php?news=' . $ligne['news_id']. '">Modifier</a></div>';
				echo '<div id="option_modifier_news"><a href="supprimer_news.php?news=' . $ligne['news_id']. '" target="_blank">Supprimer</a></div>';
			}
		}
	}
	echo '</div>';
}


echo '<center><';
for($x=1; $x<=$nb_pages; $x++) 
    { 
		echo '<a href="news.php?page=' . $x . '">' . $x . '</a>';
    } 
echo '></center>';
?>
</body>