<div class="container">
		<div class="row">
			<div class="col-xs-3">
				
				<?php
					if(empty($_GET['uid']))
						$id = $_SESSION['user_id'];
					else 
						$id = $_GET['uid'];
					$res = $mysqli->query("SELECT * FROM users WHERE id = $id");
					while($obj = $res->fetch_object()){
				?>
				<img src="<?php echo $obj->avatar; ?>" class="img-thumbnail" alt="profile avatar" width="400" height="350">
				<br></br>
				<ul class="list-group">
					<li class="list-group-item"><?php echo $obj->name . " " . $obj->surname?></li>
					<li class="list-group-item"><?php echo "Nato il " . $obj->date_of_birth; ?></li>
					<li class="list-group-item"><?php echo "Nato a " . $obj->place_of_birth; ?></li>
					<li class="list-group-item"><?php echo "Biografia: \r\n" . $obj->biography; ?></li>
				<?php
					}
				?>
				</ul>
			</div>