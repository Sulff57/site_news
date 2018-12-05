<?php
include('config.php');
include('pub_logos.php');

echo '<center>Vous pouvez ajouter jusqu\'à 3 logos différents.<br><br><br>___________________________________<br>';

function afficher_logo($id)
{
	$req = mysql_query("SELECT * FROM logos WHERE id=".$id."") or die(mysql_error());

	$ligne = mysql_fetch_array($req);
	$path = $ligne['path'];
	$url = $ligne['url'];
	

	echo 'Logo '.$id.':';
	afficher_pub('horizontal', $id);

	if (!EMPTY($path)) {
	echo '<FORM method="post" action ="supprimer_logo.php">
		<INPUT type=hidden name=num_logo VALUE='.$id.'>
		<INPUT type=submit value="Supprimer"><br>
		</FORM>';
	}
	
	echo '<FORM method="POST" action="verif_logo.php" ENCTYPE="multipart/form-data">
			  <INPUT type=hidden name=MAX_FILE_SIZE VALUE=200000>
			  <INPUT type=hidden name=num_logo VALUE='.$id.'>
			  url <INPUT type=text name="url" value="'.$url.'"><br>
			  <INPUT type=file name="file">
			  <INPUT type=submit value="Envoyer"><br>
			  <br>___________________________________
	</FORM>';
}

$nb_logos = mysql_query("SELECT * FROM logos");
$nb_logos = mysql_num_rows($nb_logos);

for ($x=1;$x<=$nb_logos;$x++) {
	afficher_logo($x);
}

?>