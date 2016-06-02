<?php
	session_start();
	include("db.php");
		$id = $_SESSION['user_id'];
		$res = $mysqli->query("SELECT * FROM users INNER JOIN friendships ON ((users.id = friendships.id_sender OR users.id = friendships.id_receiver) AND users.id != $id) AND (friendships.id_sender = $id OR friendships.id_receiver = $id) ORDER BY (SELECT level FROM user_interests WHERE id_1 = $id AND id_2 = users.id) DESC");
			while($obj = $res->fetch_object()){
				echo $obj->email . "<br></br>";
			}
?>