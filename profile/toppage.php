<?php
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
		<div class="col-xs-9">
<?php
	if($id === $_SESSION['user_id']){
?>
				<form role="form" id="new_post" method="post" action="">
					<div class="form-group">
						<textarea class="form-control" cols="50" rows="5" style="resize:none;" name="post_text"></textarea><br>
						<button type="submit" class="btn btn-default">Invia</button>
					</div>
				<br></br>
<?php
	}
?>