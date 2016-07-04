<?php
	session_start();
	include("db.php");
?>
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
		echo "<div class=\"alert alert-danger\"><strong>Errore!</strong> Hai già effettuato il login!</div>";
	} else {
		if(isset($_POST['email'])){
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$res = $mysqli->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
				if($obj = $res->fetch_object()){
					$_SESSION['user_id'] = $obj->id;
					echo "<div class=\"alert alert-success\"><strong>Perfetto!</strong> Login Effettuato!</div>";
					header("Location: ./index.php");
				} else {
					echo "<div class=\"alert alert-danger\"><strong>Errore!</strong> Controlla i dati inseriti!</div>";
				}
		}
?>
	<form role="form" action="" method="post">
		<div class="form-group">
			<label for="pwd">Indirizzo Email:</label>
			<input type="email" class="form-control" name="email"></input>
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" name="password"></input>
		<br>
		<button type="submit" class="btn btn-default">Invia </button>
		</div>
	</form>
<?php
	}
?>
	</div>
</body>
</html>