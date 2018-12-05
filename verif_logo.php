<?php
session_start();
include('config.php');
include('get_droits_membre.php');

$login = $_SESSION['login'];
$droits_login = get_droits_membre($login);


if ($droits_login['membres_droits_config'] == 1) {

	if ($_FILES['file']['error']) {
			  switch ($_FILES['file']['error']){
					   case 1: // UPLOAD_ERR_INI_SIZE
					   echo"Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
					   break;
					   case 2: // UPLOAD_ERR_FORM_SIZE
					   echo "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
					   break;
					   case 3: // UPLOAD_ERR_PARTIAL
					   echo "L'envoi du fichier a été interrompu pendant le transfert !";
					   break;
					   case 4: // UPLOAD_ERR_NO_FILE
					   echo "Le fichier que vous avez envoyé a une taille nulle !";
					   break;
			  }
	}
	else {



		if(isset($_FILES['file']))
		{ 
			$num_logo = $_POST['num_logo'];
			$fichier = basename($_FILES['file']['name']);
			$url = htmlspecialchars($_POST['url']);
			mysql_query('UPDATE logos SET path="'.$fichier.'", url="'.$url.'" WHERE id='.$_POST["num_logo"].'') or die(mysql_error());
			
			$dossier = '../images_upload/';
			

			$tmp_name = $_FILES["name"]["tmp_name"];
			$name = $_FILES["name"]["name"];
			if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			 {
				  echo 'Upload effectué avec succès !';
			 }
			 else //Sinon (la fonction renvoie FALSE).
			 {
				  echo 'Echec de l\'upload !';
			 }
		}
	}
}
?>