		<div class="col-xs-9">
<?php
	if(!empty($_GET['id'])){
		$time = time();
		$receiver = $_GET['id'];
		if($_GET['mode'] == "send"){
			$mysqli->query("INSERT INTO friendships(id_sender, id_receiver, date_of_request, state) VALUES('$id', '$receiver', '$time', '0')");
		} else {
			$mysqli->query("DELETE FROM friendships WHERE (id_sender = '$id' OR id_sender = '$receiver') AND (id_receiver = '$id' OR id_receiver = '$receiver')");
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	
	if(!empty($_GET['search'])){	
		$searchkey = $_GET['search'];
		$res = $mysqli->query("SELECT * FROM users WHERE (name LIKE '%$searchkey%' OR surname LIKE '%$searchkey%' OR email LIKE '%$searchkey%') AND id != $id");
		while($obj = $res->fetch_object()){
			$friend = $obj->id;
			$res2 = $mysqli->query("SELECT * FROM friendships WHERE (id_sender = '$id' OR id_sender = '$friend') AND (id_receiver = '$id' OR id_receiver = '$friend')");
?>
			<div class="row">
				<div class="col-xs-1">
					<img src="<?php echo $obj->avatar; ?>" class="img-circle" height="45" width="45" alt="avatar">
				</div>
				<div class="col-xs-10">
					<a href="profile.php?uid=<?php echo $obj->id; ?>"><h4><?php echo $obj->name . " " . $obj->surname; ?></h4></a>
					<br>
				</div>
				<div class="col-xs-1">
					<?php if($obj2 = $res2->fetch_object()){
								if($obj2->state == "1")
									echo "<a href=\"" . $_SERVER['REQUEST_URI'] . "&mode=remove&id=" . $friend . "\"><span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span></a>";
								else
									echo "<a href=\"" . $_SERVER['REQUEST_URI'] . "&mode=remove&id=" . $friend . "\"><span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span></a>";
							} else {
								echo "<a href=\"?dir=search&mode=send&id=" . $friend . "\"><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span></a>";
							}
					?>
				</div>
			</div>
<?php
		}
	}
?>
		</div>
	</div>
</body>
</html>