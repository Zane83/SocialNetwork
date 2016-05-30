<?php
	session_start();
	include("db.php");
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$res = $mysqli->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
			if($obj = $res->fetch_object()){
				$_SESSION['user_id'] = $obj->id;
				echo "Login effettuato!";
			} else {
				echo "Errore durante il login!";
			}
	}
?>

<form id="login" method="post" action="">
	<p>Email: <input type="text" name="email"></input></p>
	<p>Password: <input type="password" name="password"></input></p>
	<input type="submit"></input>
</form>