<?php
	if(isset($_POST['post_text'])){
		if($stmt = $mysqli->prepare("INSERT INTO posts(id_user, text, date_of_publication) VALUES(?,?,?)")){
			$stmt->bind_param('iss', $_SESSION['user_id'], $_POST['post_text'], date("Y-m-d"));
			if(empty($_POST['post_text']))
				$_POST['post_text'] = null;
			
			if(!$stmt->execute())
				echo "<div class=\"alert alert-danger\"><strong>Errore!</strong> Non hai inserito il testo!</div>";
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
	<small><h2>Post recenti</h2></small>
	<hr>
	</form>
<?php
		$res = $mysqli->query("SELECT posts.text, posts.date_of_publication, posts.id, users.avatar, users.name, users.surname FROM posts, users WHERE posts.id_user = $id AND users.id = $id ORDER BY posts.date_of_publication, posts.id DESC");
			while($obj = $res->fetch_object()){
				$postid = $obj->id;
?>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-1"><a href="<?php echo "./profile.php?uid=" . $id; ?>"><img src="<?php echo $obj->avatar; ?>" class="img-circle" alt="<?php echo $obj->name; ?>" width="60" height="60"></a></div>
							<div class="col-xs-11"><h3><?php echo $obj->name . " " . $obj->surname; ?></h3></div>
						</div>
						<h5><span class="glyphicon glyphicon-time"></span> Postato il giorno <?php echo $obj->date_of_publication; ?></h5>
						<p><?php echo $obj->text; ?></p>
						<button type="button" class="btn btn-default" onclick="likecomment(<?php echo $_SESSION['user_id'] . "," . $postid . ",'like'"; ?>)"><span class="glyphicon glyphicon-thumbs-up" id="like_button"></span></button>
						<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-comment"></span></button>
						<small><a href="index.php?dir=single&post_id=<?php echo $postid; ?>"><?php echo "   " . $mysqli->query("SELECT * FROM likes WHERE id_post = '$postid'")->num_rows . " like e " . $mysqli->query("SELECT * FROM comments WHERE id_post = '$postid'")->num_rows . " commenti"; ?></a></small>
					</div>
				</div>
<?php
			}
?>
		</div>
	</div>
</body>
</html>