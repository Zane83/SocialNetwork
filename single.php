		<div class="col-xs-9">
			<?php 
				if(empty($_GET['post_id'])){
					header("Location: index.php");
				}
				$post_id = $_GET['post_id'];
				if(isset($_POST['comment_text'])){
					if($stmt = $mysqli->prepare("INSERT INTO comments(id_user, id_post, text, date) VALUES(?,?,?,?)")){
						$stmt->bind_param('iisi', $id, $post_id, $_POST['comment_text'], time());
						if(empty($_POST['comment_text']))
							$_POST['comment_text'] = null;
						
						if(!$stmt->execute()){
							echo "<div class=\"alert alert-danger\"><strong>Errore!</strong> Non hai inserito il testo!</div>";
						} else {
							$time = time();
							$id_2 = $mysqli->query("SELECT id_user FROM posts WHERE id = '$post_id'")->fetch_object()->id_user;
							$mysqli->query("UPDATE user_interests SET level = level + 1 WHERE id_1 = '$id' AND id_2 = '$id_2'");
							$id_type = $mysqli->query("SELECT MAX(id) AS id FROM comments")->fetch_object()->id;
							$mysqli->query("INSERT INTO notifies (id_user, id_receiver, id_post, type, id_type, viewed, date) VALUES('$id','$id_2','$post_id','commento','$id_type','0','$time')");
						}
							
					}
				}
				
				
				$res = $mysqli->query("SELECT posts.text, posts.date_of_publication, posts.id, users.avatar, users.name, users.surname FROM posts, users WHERE posts.id = $post_id AND users.id = posts.id_user");
				while($obj = $res->fetch_object()){
			?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-1"><a href="<?php echo "./profile.php?uid=" . $obj->id_user; ?>"><img src="<?php echo $obj->avatar; ?>" class="img-circle" alt="<?php echo $obj->name; ?>" width="60" height="60"></a></div>
						<div class="col-xs-11"><h3><?php echo $obj->name . " " . $obj->surname; ?></h3></div>
					</div>
					<h5><span class="glyphicon glyphicon-time"></span> Postato il giorno <?php echo $obj->date_of_publication; ?></h5>
					<p><?php echo $obj->text; ?></p>
					<button type="button" class="btn btn-default" onclick="likecomment(<?php echo $_SESSION['user_id'] . "," . $post_id . ",'like'"; ?>)"><span class="glyphicon glyphicon-thumbs-up" id="like_button"></span></button>
					<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-comment"></span></button>
					<small><a href=#><?php echo "   " . $mysqli->query("SELECT * FROM likes WHERE id_post = '$post_id'")->num_rows . " like e " . $mysqli->query("SELECT * FROM comments WHERE id_post = '$post_id'")->num_rows . " commenti"; ?></a></small>
				</div>
			</div>
			<?php
				}
			?>
			<br>
			<form role="form" id="new_comment" method="post" action="?dir=single&post_id=<?php echo $post_id; ?>">
				<div class="form-group">
					<textarea class="form-control" cols="50" rows="5" style="resize:none;" name="comment_text"></textarea><br>
					<button type="submit" class="btn btn-default">Invia</button>
				</div>
			</form>
			<br>
			<p><span class="badge"></span> Commenti:</p><br>
			<?php
				$res = $mysqli->query("SELECT users.name, users.surname, users.avatar, comments.text, comments.date FROM comments, users WHERE comments.id_post = '$post_id' AND users.id = comments.id_user ORDER BY comments.date DESC");
				while($obj2 = $res->fetch_object()){
			?>
			<div class="row">
				<div class="col-xs-2 text-center">
					<img src="<?php echo $obj2->avatar; ?>" class="img-circle" height="65" width="65" alt="avatar">
				</div>
				<div class="col-xs-10">
					<h4><?php echo $obj2->name . " " . $obj2->surname; ?> <small><?php echo date("d-m-Y H:i",$obj2->date); ?></small></h4>
					<p><?php echo $obj2->text; ?></p>
					<br>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
</body>
</html>