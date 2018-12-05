<?php

function returnFrenchDate($date,$prefix="",$suffix="") {//cette fonction accepte les date au format AAAA-MM-JJ HH:MM
	$tab_month = array(1=>"Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre");
	$tab_day = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
	$tab_date = explode(' ', $date);
	$date_hour = explode(':', $tab_date[1]);
	$tab_dmy = explode('-', $tab_date[0]);
	settype($tab_dmy[1], integer);
	$jour=($tab_dmy[2])?$prefix." ".$tab_day[date("w", mktime(0, 0, 0, $tab_dmy[1], $tab_dmy[2], $tab_dmy[0]))]." ".$tab_dmy[2]:"";
	$mois=$tab_month[$tab_dmy[1]];
	$annee=$tab_dmy[0];
	$minute=($date_hour[1])?$date_hour[1]."mn":"";
	$heure=($date_hour[0])?$suffix." ".$date_hour[0]."h":"";
	return $jour." ".$mois." ".$annee;
}
?>