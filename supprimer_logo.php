<?php
session_start();
include('config.php');
include('get_droits_membre.php');

$login = $_SESSION['login'];
$droits_login = get_droits_membre($login);

if ($droits_login['membres_droits_config'] == 1) {
	mysql_query("UPDATE logos SET path=NULL, url=NULL WHERE id=".$_POST['num_logo']."")or die (mysql_error());
	if (!mysql_error()) {
		echo 'Suppression effectuée avec succès.';
	}
}
