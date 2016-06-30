<?php 
	session_start();
	include("db.php");
	if(empty($_SESSION['user_id'])){
		header("Location: login.php");
	}
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
  <script>
	function likecomment(userid, postid, type) {
        var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if(xmlhttp.responseText == "liked"){
					document.getElementById("like_button").style.color = "#11abd7";
				}
				else{
					document.getElementById("like_button").style.color = "#000";
				}
            }
        };
        xmlhttp.open("GET", "likecomment.php?user_id=" + userid + "&post_id=" + postid + "&type=" + type, true);
        xmlhttp.send();
    }
  </script>
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
							echo "<li><a href=\"./reg.php\"><span class=\"glyphicon glyphicon-user\"></span> Registrati</a></li>";
							echo "<li><a href=\"./login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
						} else {
							$id = $_SESSION['user_id'];
							$res = $mysqli->query("SELECT avatar FROM users WHERE id = $id");
							$count_n = $mysqli->query("SELECT COUNT(*) AS count_n FROM notifies WHERE id_receiver = '$id' AND viewed = '0'")->fetch_object()->count_n + $mysqli->query("SELECT COUNT(*) AS count_r FROM friendships WHERE id_receiver = '$id' AND state = '0'")->fetch_object()->count_r;
							echo "<li><a href=\"./profile.php\"><img src=\"" . $res->fetch_object()->avatar . "\" class=\"img-circle\" alt=\"Antonio\" width=\"25\" height=\"25\"></a></li>";	
							echo "<li><a href=\"?dir=notifies\"><span class=\"badge\">" . $count_n . "</span></a></li>";
							echo "<li><a href=\"./logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";
						}
					?>
					
					
				</ul>
			</div>
			
			<form class="navbar-form" role="search" method="get" action="index.php">
				<div class="input-group" style="display:table;">
					<input type="hidden" name="dir" value="search" />
					<input type="text" class="form-control" placeholder="Cerca..." name="search">
					<span class="input-group-addon" style="width:1%;"><span class="glyphicon glyphicon-search"></span></span>
				</div>
			</form>
		</div>
	</nav>
