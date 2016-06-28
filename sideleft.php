<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<h2>Top Friends:</h2>
				<div class="list-group">
					<div class="row">
					<?php 
						$id = $_SESSION['user_id'];
						$res = $mysqli->query("SELECT users.id,users.name,users.surname,users.avatar FROM users INNER JOIN friendships ON ((users.id = friendships.id_sender OR users.id = friendships.id_receiver) AND users.id != $id) AND (friendships.id_sender = $id OR friendships.id_receiver = $id) AND friendships.state = '1' ORDER BY (SELECT level FROM user_interests WHERE id_1 = $id AND id_2 = users.id) DESC");
						while($obj = $res->fetch_object()){
							echo "<a href=\"./profile.php?uid=" . $obj->id . "\" class=\"list-group-item\">" . $obj->name . " " . $obj->surname . "</a>";
						}
					?>
					</div>
				</div>
			</div>