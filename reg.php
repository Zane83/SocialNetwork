<?php
	session_start();
	include("db.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <title>Fakebook</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mobilenavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="./index.php"><img alt="Fakebook" src="./media/logo.png"></a>
			</div>
			<div class="collapse navbar-collapse navbar-right" id="mobilenavbar">
				<ul class="nav navbar-nav navbar-right">
						<li><a href="./reg.php"><span class="glyphicon glyphicon-user"></span> Registrati</a></li>
						<li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>	
				</ul>
			</div>
			
			<form class="navbar-form" role="search">
				<div class="input-group" style="display:table;">
					<input type="text" class="form-control" placeholder="Cerca...">
					<span class="input-group-addon" style="width:1%;"><span class="glyphicon glyphicon-search"></span></span>
				</div>
			</form>
		</div>
	</nav>
	<div class="container">
<?php
	if(isset($_SESSION['user_id'])){
		echo "<div class=\"alert alert-danger\"><strong>Errore!</strong> Sei già registrato!</div>";
	} else {
		if(isset($_POST['name'])){
				if($stmt = $mysqli->prepare("INSERT INTO users(name,surname,email,password,place_of_birth,date_of_birth,avatar,biography) VALUES(?,?,?,?,?,?,?,?)")){
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
					$stmt->bind_param('sssssiss', $_POST['name'], $_POST['surname'], $_POST['email'], md5($_POST['password']), $_POST['place_of_birth'], strtotime($_POST['date_of_birth']), $_POST['avatar'], $_POST['biography']);
					foreach($_POST as &$value){
						if(empty($value))
							$value = null;
					}
					if($stmt->execute())
						echo "<div class=\"alert alert-success\"><strong>Perfetto!</strong> La registrazione è avvenuta correttamente</div>";
					else
						echo "<div class=\"alert alert-danger\"><strong>Errore!</strong> Controlla di aver riempito tutti i campi oppure l'email è già in uso!</div>";
				}
			}
?>
		<form role="form" action="" method="post" enctype="multipart/form-data">
		  <div class="form-group">
			<label for="pwd">Indirizzo Email:</label>
			<input type="email" class="form-control" name="email"></input>
		  </div>
		  <div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" name="password"></input>
		  </div>
		  <div class="form-group">
			<label for="pwd">Nome:</label>
			<input type="text" class="form-control" name="name"></input>
		  </div>
		  <div class="form-group">
			<label for="pwd">Cognome:</label>
			<input type="text" class="form-control" name="surname"></input>
		  </div>
		  <div class="form-group">
			<label for="pwd">Luogo di nascita:</label>
			<input type="text" class="form-control" name="place_of_birth"></input>
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
			<textarea class="form-control" rows="5" name="biography" style="resize:none;"></textarea>
		  </div>
		  <button type="submit" class="btn btn-default">Invia </button>
		</form>
<?php
	}
?>
	</div>
</body>
</html>