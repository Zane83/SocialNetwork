<?php
	session_start();
	include("db.php");
	if(isset($_POST['post_text'])){
		if($stmt = $mysqli->prepare("INSERT INTO posts(id_user, text, date_of_publication) VALUES(?,?,?)")){
			$stmt->bind_param('iss', $_SESSION['user_id'], $_POST['post_text'], date("Y-m-d"));
			if(empty($_POST['post_text']))
				$_POST['post_text'] = null;
			
			if(!$stmt->execute())
				echo "Errore!Non hai inserito il testo!";
		}
	}
?>
<form id="new_post" method="post" action="">
	<p>Testo: <textarea cols="50" rows="10" name="post_text"></textarea></p>
	<input type="submit"></input>
</form>