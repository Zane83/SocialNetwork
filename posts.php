<?php
	session_start();
	include("db.php");
		$id = $_SESSION['user_id'];
		$res = $mysqli->query("SELECT * FROM posts INNER JOIN friendships ON ((posts.id_user = friendships.id_sender OR posts.id_user = friendships.id_receiver) AND posts.id_user != $id) AND (friendships.id_sender = $id OR friendships.id_receiver = $id) ORDER BY (SELECT level FROM user_interests WHERE id_1 = $id AND id_2 = posts.id_user) DESC");
			while($obj = $res->fetch_object()){
				echo $obj->text . "<br></br>";
			}
?>