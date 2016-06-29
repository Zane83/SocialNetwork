		<div class="col-xs-9">
<?php
	if(!empty($_GET['id'])){
		$fid = $_GET['id'];
		if($_GET['mode'] == "accept"){
			$mysqli->query("UPDATE friendships SET state = '1' WHERE id = $fid");
		} else {
			$mysqli->query("DELETE FROM friendships WHERE id = $fid");
		}
	}
	
	if(!empty($_GET['nid'])){
		$nid = $_GET['nid'];
			$mysqli->query("UPDATE notifies SET viewed = '1' WHERE id = $nid");

	}
	
	$res = $mysqli->query("SELECT users.name, users.surname, users.avatar, notifies.id_post, notifies.type, notifies.date, notifies.id FROM notifies INNER JOIN users ON users.id = notifies.id_user WHERE notifies.id_receiver = '$id' AND notifies.viewed = '0'");
	while($obj = $res->fetch_object()){
?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-1">
							<img src="<?php echo $obj->avatar; ?>" class="img-circle" height="45" width="45" alt="avatar">
						</div>
						<div class="col-xs-10">
							<a href="?dir=single&post_id=<?php echo $obj->id_post; ?>">
								<h4><?php echo $obj->name . " " . $obj->surname . " ha inserito un " . $obj->type . " al tuo post - " . date("H:i:s d-m-Y", $obj->date); ?></h4>
							</a>
						</div>
						<div class="col-xs-1">
							<a href="?dir=notifies&nid=<?php echo $obj->id; ?>"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
						</div>
					</div>
				</div>
			</div>
<?php 
	}
	$res = $mysqli->query("SELECT users.name, users.surname, users.avatar, friendships.id, friendships.date_of_request FROM friendships INNER JOIN users ON users.id = friendships.id_sender WHERE friendships.id_receiver = '$id' AND friendships.state = '0'");
	while($obj = $res->fetch_object()){
?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-1">
							<img src="<?php echo $obj->avatar; ?>" class="img-circle" height="45" width="45" alt="avatar">
						</div>
						<div class="col-xs-9">
							<h4><?php echo $obj->name . " " . $obj->surname . " ti ha inviato una richiesta di amicizia - " . date("H:i:s d-m-Y", $obj->date_of_request); ?></h4>
						</div>
						<div class="col-xs-1">
							<a href="?dir=notifies&mode=accept&id=<?php echo $obj->id; ?>"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
						</div>
						<div class="col-xs-1">
							<a href="?dir=notifies&mode=remove&id=<?php echo $obj->id; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
						</div>
					</div>
				</div>
			</div>
<?php
	}
?>
		</div>
	</div>
</body>
</html>