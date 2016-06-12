<?php
	if(empty($_GET['dir']))
		$dir = "posts";
	else 
		$dir = $_GET['dir'];
?>	
		<?php include("header.php");?>
			<?php include("sideleft.php");?>
			<?php include($dir . ".php");?>