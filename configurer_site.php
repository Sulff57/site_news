<?php
session_start();
include('config.php');
include('get_droits_membre.php');

$req = mysql_query("SELECT * FROM config")or die(mysql_error());
$req = mysql_fetch_array($req);

$nb_news = $req['config_news_par_page'];
$is_enabled_comments = $req['config_commentaires_active'];
$nb_membres = $req['config_membres_par_page'];
$max_height_logo = $req['max_height_logo'];
$max_width_logo = $req['max_width_logo'];

if (ISSET($_POST['nb_news'])) {
	echo $_POST['nb_news'];
}
if (ISSET($_POST['submit_commentaires'])) {
	echo $_POST['submit_commentaires'];
}
if (ISSET($_POST['nb_membres'])) {
	echo $_POST['nb_membres'];
}
if (ISSET($_POST['max_height_logo'])) {
	echo $_POST['max_height_logo'];
	echo $_POST['max_width_logo'];
}


echo '<form method="post" name="form" action="configurer_site.php">
	Nombre de news par page <INPUT type=text name="nb_news" value="'.$nb_news.'">
	<INPUT type=submit name=submit_news value="Ok"><br>
	</form>';
echo '<form method="post" name="form" action="configurer_site.php">
	Activer commentaires (fonction non effective pour l\'instant)
	<INPUT type=submit name=submit_commentaires value=oui>
	<INPUT type=submit name=submit_commentaires value=non><br>
	</form>';
echo '<form method="post" name="form" action="configurer_site.php">
	Nombre de membres par page<INPUT type=text name="nb_membres" value="'.$nb_membres.'">
	<INPUT type=submit name=submit_membres value="Ok"><br>
	</form>';
echo '<form method="post" name="form" action="configurer_site.php">
	Hauteur max logo<INPUT type=text name="max_height_logo" value="'.$max_height_logo.'"><br>
	Largeur max logo<INPUT type=text name="max_width_logo" value="'.$max_width_logo.'">
	<INPUT type=submit name=submit_taille value="Ok">
	</form>';
