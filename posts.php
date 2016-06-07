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