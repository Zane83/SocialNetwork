<?php
	include("db.php");
	if($_GET['type'] === "like"){
		$id_user = $_GET['user_id'];
		$id_post = $_GET['post_id'];
		if($obj = $mysqli->query("SELECT * FROM likes WHERE id_user = '$id_user' AND id_post = '$id_post'")->fetch_object()){
			$mysqli->query("DELETE FROM likes WHERE id_user = '$id_user' AND id_post = '$id_post'");
			$id_2 = $mysqli->query("SELECT id_user FROM posts WHERE id = '$id_post'")->fetch_object()->id_user;
			$mysqli->query("UPDATE user_interests SET level = level - 1 WHERE id_1 = '$id_user' AND id_2 = '$id_2'");
			echo "deleted";
		} else {
			$time = time();
			$mysqli->query("INSERT INTO likes (id_user, id_post, date) VALUES('$id_user','$id_post','$time')");
			$id_type = $mysqli->query("SELECT MAX(id) AS id FROM likes")->fetch_object()->id;
			$id_2 = $mysqli->query("SELECT id_user FROM posts WHERE id = '$id_post'")->fetch_object()->id_user;
			$mysqli->query("INSERT INTO notifies (id_user, id_receiver, id_post, type, id_type, viewed, date) VALUES('$id_user','$id_2','$id_post','like','$id_type','0','$time')");
			$mysqli->query("UPDATE user_interests SET level = level + 1 WHERE id_1 = '$id_user' AND id_2 = '$id_2'");
			echo "liked";
		}
	}
?>