<?php
	$res = $mysqli->query("SELECT password,name,surname,place_of_birth,date_of_birth,avatar,biography FROM users WHERE id = $id");
	while($obj = $res->fetch_array()){
		if(!empty($_GET['edit']) && $_GET['edit'] === "yes"){
			if($stmt = $mysqli->prepare("UPDATE users SET name = ?,surname = ?, password = ?,place_of_birth = ?,date_of_birth = ?,avatar = ?,biography = ? WHERE id = $id")){
				if(!empty($_POST['password']))
					$_POST['password'] = md5($_POST['password']);
				
				if($_FILES['avatar']['error'] == UPLOAD_ERR_OK){
									if(getimagesize($_FILES['avatar']['tmp_name'])){
										$dir = "./media/images/profile_images/" . time() . rand(0000,9999) . "." . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
										move_uploaded_file($_FILES['avatar']['tmp_name'], $dir);
										$_POST['avatar'] = $dir;
									} else {
										$_POST['avatar'] = $obj['avatar'];
									}
								} else {
									$_POST['avatar'] = $obj['avatar'];
								}
				$stmt->bind_param('ssssiss', $_POST['name'], $_POST['surname'], $_POST['password'], $_POST['place_of_birth'], $_POST['date_of_birth'], $_POST['avatar'], $_POST['biography']);
				foreach($_POST as $key => &$value){
					if(empty($value))
						$value = $obj[$key];
				}
				if(!$stmt->execute())
					echo "<div class=\"alert alert-danger\"><strong>Errore!</strong> Qualcosa è andato storto nella modifica delle informazioni.</div>";
			}
		}
	}
?>	
		<div class="col-xs-9">
			<form role="form" action="?dir=edit_profile&edit=yes" method="post" enctype="multipart/form-data">
			  <div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" name="password" placeholder="Modifica la password del tuo account..."></input>
			  </div>
			  <div class="form-group">
				<label for="pwd">Nome:</label>
				<input type="text" class="form-control" name="name" placeholder="Modifica il cognome del tuo account..."></input>
			  </div>
			  <div class="form-group">
				<label for="pwd">Cognome:</label>
				<input type="text" class="form-control" name="surname" placeholder="Modifica il nome del tuo account..."></input>
			  </div>
			  <div class="form-group">
				<label for="pwd">Luogo di nascita:</label>
				<input type="text" class="form-control" name="place_of_birth" placeholder="Modifica il luogo di nascita..."></input>
			  </div>
			  <div class="form-group">
				<label for="pwd">Data di nascita:</label>
				<input type="date" class="form-control" name="date_of_birth"></input>
			  </div>
			  <div class="form-group">
				<label for="pwd">Avatar:</label>
				<input type="file" class="form-control" name="avatar" accept="image/*"></input>
			  </div>
			  <div class="form-group">
				<label for="pwd">Biografia:</label>
				<textarea class="form-control" rows="5" name="biography" style="resize:none;" placeholder="Modifica la tua biografia..."></textarea>
			  </div>
			  <button type="submit" class="btn btn-default">Invia </button>
			</form>
		</div>
	</div>
</body>
</html>