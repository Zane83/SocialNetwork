<?php
	if(empty($_GET['dir']))
		$dir = "posts";
	else 
		$dir = $_GET['dir'];
?>
		<?php include("./header.php");?>
			<?php include("./profile/sideleft.php");?>
			<?php include("./profile/" . $dir . ".php");?>