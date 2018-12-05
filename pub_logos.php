<?
include('config.php');



function afficher_pub($orientation='horizontal', $id=0)
{
	$req = mysql_query("SELECT * FROM logos") or die(mysql_error());

	$req2 = mysql_query("SELECT max_height_logo, max_width_logo FROM config");
	$req2 = mysql_fetch_array($req2);
	$max_width = $req2['max_width_logo'];
	$max_height = $req2['max_height_logo'];
	
	echo '<center>';
	while ($ligne = mysql_fetch_array($req))
	{
		$path = $ligne['path'];
		$url = $ligne['url'];
		$size = GetImageSize('../images_upload/'.$path.'');  
		$src_w = $size[0]; $src_h = $size[1];
		$ligne_id = $ligne['id'];
		
		if ( (ISSET($path)) && (ISSET($url)) && ( ($id == $ligne_id) || ($id == 0) )  )
		{
			if (($src_w > $max_width) && ($src_h <= $max_height))
			{
				echo '<a href="http://'.$url.'"><img src="../images_upload/'.$path.'" WIDTH='.$max_width.' ></a>'; // on spécifie juste width si height pas trop grand pour laisser les proportions
				if ($orientation == "vertical")
				{
				echo '<br>';
				}
			}
			elseif (($src_w > $max_width) && ($src_h > $max_height))
			{
				if ($src_w > $src_h) // on redimensionne sur la base du plus grand pour garder les proportions
				{
					echo '<a href="http://'.$url.'"><img src="../images_upload/'.$path.'" WIDTH='.$max_width.' ></a>';
					if ($orientation == "vertical")
					{
					echo '<br>';
					}
				}
				else
				{
					echo '<a href="http://'.$url.'"><img src="../images_upload/'.$path.'" HEIGHT="'.$max_height.'" ></a>';
					if ($orientation == "vertical")
					{
					echo '<br>';
					}
				}
			}
			elseif (($src_w <= $max_width) && ($src_h > $max_height))
			{
				echo '<a href="http://'.$url.'"><img src="../images_upload/'.$path.'" HEIGHT="'.$max_height.'" ></a>';
				if ($orientation == "vertical")
				{
				echo '<br>';
				}
			}
			elseif (( $src_w <= $max_width) && ($src_h <= $max_height))
			{
				echo '<a href="http://'.$url.'"><img src="../images_upload/'.$path.'" ></a>';
				if ($orientation == "vertical")
				{
				echo '<br>';
				}
			}
			
		}
	}
	echo '</center>';
}

?>