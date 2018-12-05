<?php
session_start();
include('config.php');
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
	if ( (EMPTY($_POST['pseudo'])) || EMPTY($_POST['mdp']) || EMPTY($_POST['mdp_match'])|| (EMPTY($_POST['nom'])) || (EMPTY($_POST['prenom'])) || (EMPTY($_POST['fonction'])) )
	{

		if ($_GET['new'] == 0) 
		{
			echo 'Vous avez omis de remplir un ou plusieurs champs. Veuillez recommencer votre saisie à nouveau :';
		}
		echo 
		'
			<center><div id="champs_inscription" class="style:">
			<FORM method=post action="ajouter_membre.php?new=0">
			Ajout d\'un utilisateur
			<TABLE BORDER=0>
			<TR>
				<TD>Pseudo</TD>
				<TD>
				<INPUT type=text name="pseudo">
				</TD>
			</TR>
			
			<TR>
				<TD>Mot de passe</TD>
				<TD>
				<INPUT type=password name="mdp">
				</TD>
			</TR>
			
			<TR>
				<TD>Répéter mot de passe</TD>
				<TD>
				<INPUT type=password name="mdp_match">
				</TD>

			</TR>


			<TR>
				<TD>Nom</TD>
				<TD>
				<INPUT type=text name="nom">
				</TD>
			</TR>

			<TR>
				<TD>Prénom</TD>
				<TD>
				<INPUT type=text name="prenom">
				</TD>
			</TR>

			<TR>
				<TD>Fonction</TD>
				<TD>
				<SELECT name="fonction">
					<OPTION VALUE="membre">Membre</OPTION>
					<OPTION VALUE="admin">Admin</OPTION>	</SELECT>
				</TD>
			</TR>

			<TR>
				<TD COLSPAN=2>
				<INPUT type="submit" value="Envoyer">
				</TD>
			</TR>
			</TABLE>
			</FORM>
			</div></center>

		';
	}
	elseif ( $_GET['new'] == 0 )
	{

		$droits = 0;

		if ($_POST['fonction'] == 'admin')
		{
			$droits = 1;
		}

		$password = $_POST['mdp'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$pseudo = $_POST['pseudo'];
		
		mysql_query("INSERT INTO membres
		VALUES('$password', '$prenom', '$nom', '$pseudo', NOW(), '$droits', '$droits', '$droits', '$droits')") or die('Erreur : Pseudo déjà existant. Veuillez revenir en arrière et en choisir un différent.'.mysql_error());

		echo '<script language="javascript" type="text/javascript">
			<!--
			window.location.replace("./interface_admin.php");
			-->
			</script>';
	}
}

?>


 </body>