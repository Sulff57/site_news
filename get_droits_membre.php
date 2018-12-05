<?php 

function get_droits_membre($login)
{
	if ($login != "")
	{
		$req = mysql_query("SELECT membres_droits_ajouter_membre, membres_droits_ajouter_news, membres_droits_controles_membre, membres_droits_controles_news, membres_droits_config FROM membres WHERE login='" . $login . "'") or die(mysql_error());
		
		$req = mysql_fetch_assoc($req);
		
		return $req;
	}
}
?>