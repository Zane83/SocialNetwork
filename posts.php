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
				<form role="form" id="new_post" method="post" action="">
					<div class="form-group">
						<textarea class="form-control" cols="50" rows="5" style="resize:none;" name="post_text"></textarea><br>
						<button type="submit" class="btn btn-default">Invia</button>
					</div>
				<br></br>
	<small><h2>Post recenti</h2></small>
	<hr>
	</form>
<?php
		$id = $_SESSION['user_id'];
		$res = $mysqli->query("SELECT * FROM posts INNER JOIN friendships ON ((posts.id_user = friendships.id_sender OR posts.id_user = friendships.id_receiver) AND posts.id_user != $id) AND (friendships.id_sender = $id OR friendships.id_receiver = $id) ORDER BY posts.date_of_publication DESC, (SELECT level FROM user_interests WHERE id_1 = $id AND id_2 = posts.id_user) DESC ");
			while($obj = $res->fetch_object()){
				$userid = $obj->id_user;
				$obj2 = $mysqli->query("SELECT * FROM users WHERE id = '$userid'")->fetch_object();
?>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-1"><a href="<?php echo "./profile.php?uid=" . $userid; ?>"><img src="<?php echo $obj2->avatar; ?>" class="img-circle" alt="<?php echo $obj2->name; ?>" width="60" height="60"></a></div>
							<div class="col-xs-11"><h3><?php echo $obj2->name . " " . $obj2->surname; ?></h3></div>
						</div>
						<h5><span class="glyphicon glyphicon-time"></span> Postato il giorno <?php echo $obj->date_of_publication; ?></h5>
						<p><?php echo $obj->text; ?></p>
					</div>
				</div>
<?php
			}
?>
		</div>
	</div>
</body>
</html>