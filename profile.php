<?php
	if(empty($_GET['dir']))
		$dir = "./profile/posts";
	else 
		$dir = $_GET['dir'];
?>
<main>	
		<?php include("./profile/header.php");?>
			<?php include("./profile/sideleft.php");?>
			<?php include("./profile/toppage.php");?>
			<?php include($dir . ".php");?>
</main>