<?php
	include("db.php");
	if($_GET['type'] === "like"){
		$id_user = $_GET['user_id'];
		$id_post = $_GET['post_id'];
		if($obj = $mysqli->query("SELECT * FROM likes WHERE id_user = '$id_user' AND id_post = '$id_post'")->fetch_object()){
			$mysqli->query("DELETE FROM likes WHERE id_user = '$id_user' AND id_post = '$id_post'");
			echo "deleted";
		} else {
			$time = time();
			$mysqli->query("INSERT INTO likes (id_user, id_post, date) VALUES('$id_user','$id_post','$time')");
			$id_type = $mysqli->query("SELECT MAX(id) AS id FROM likes")->fetch_object()->id;
			$mysqli->query("INSERT INTO notifies (id_user, type, id_type, viewed, date) VALUES('$id_user','like','$id_type','0','$time')");
			echo "liked";
		}
	}
?>