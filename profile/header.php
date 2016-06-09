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
					<?php
						if(empty($_SESSION['user_id'])){
					?>
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<?php
						} else {
							$id = $_SESSION['user_id'];
							$res = $mysqli->query("SELECT avatar FROM users WHERE id = $id");
							echo "<li><a href=\"./profile.php\"><img src=\"" . $res->fetch_object()->avatar . "\" class=\"img-circle\" alt=\"Antonio\" width=\"25\" height=\"25\"></a></li>";
							echo "<li><a href=\"./logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";
						}
					?>
					
					
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
