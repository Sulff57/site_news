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

// le but va etre d'afficher la liste de tous les membres répartis 
// sur le nombre de pages défini dans la config
// chaque pseudo étant suivi des liens [voir][modifier] ou seulement [voir] selon les droits

$requete = mysql_query('SELECT config_membres_par_page FROM config WHERE config_switch LIKE 1');
while ($ligne = mysql_fetch_array($requete)) {

$nb_membres_par_page = $ligne['config_membres_par_page'];
}

$allow_edit = 0;
if ( ISSET($_SESSION['login']) )
{
	$login = ($_SESSION['login']);
	$droits_login = get_droits_membre($login);
	$allow_edit = $droits_login['membres_droits_controles_membre'];
}

$page_actuelle = 1;
if ( ISSET($_GET['page']) )
{
	$page_actuelle = (int)$_GET['page'];
}

$nb_total_membres = mysql_query("SELECT COUNT(*) FROM membres");
$nb_total_membres = mysql_result($nb_total_membres, 0); 
$nb_pages = ( $nb_total_membres / $nb_membres_par_page );
$nb_pages = ceil($nb_pages);
$intervalle_haut = ( $page_actuelle * $nb_membres_par_page );
$intervalle_bas = ( $intervalle_haut - $nb_membres_par_page );

$requete = mysql_query('SELECT login FROM membres LIMIT ' . ($intervalle_bas + 1). ',' . $intervalle_haut);

while ($ligne = mysql_fetch_assoc($requete))
{
	$membre = $ligne['login'];
	
	echo $membre;
	echo '<a href="profil_membre.php?pseudo=' . $membre . '">Voir</a><br>';



}

echo '<';
for($x=1; $x<=$nb_pages; $x++) 
    { 
		echo '<a href="liste_membres.php?page=' . $x . '">' . $x . '</a>';
    } 
echo '>';

?>
</body>