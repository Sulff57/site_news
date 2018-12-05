<?php 

function redirect($path)
{
	echo '<script language="javascript" type="text/javascript">
		<!--
		window.location.replace("'.$path.'");
		-->
		</script>';
}

?>