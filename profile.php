<?php
	if(empty($_GET['dir']))
		$dir = "posts";
	else 
		$dir = $_GET['dir'];
?>
<main>	
		<?php include("./profile/header.php");?>
			<?php include("./profile/sideleft.php");?>
			<?php include("./profile/" . $dir . ".php");?>
</main>