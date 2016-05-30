<?php
	include("db.php");
	if(isset($_POST['name'])){
		if($stmt = $mysqli->prepare("INSERT INTO users(name,surname,email,password,place_of_birth,date_of_birth,avatar,biography) VALUES(?,?,?,?,?,?,?,?)")){
			$stmt->bind_param('sssssiss', $_POST['name'], $_POST['surname'], $_POST['email'], md5($_POST['password']), $_POST['place_of_birth'], $_POST['date_of_birth'], $_POST['avatar'], $_POST['biography']);
			foreach($_POST as &$value){
				if(empty($value))
					$value = null;
			}
			if(!$stmt->execute())
				echo "Errore!Controlla di aver riempito tutti i campi oppure l'email è già in uso!";
		}
	}
?>	
<form id="registration" method="post" action="">
	<p>Nome: <input type="text" name="name"></input></p>
	<p>Cognome: <input type="text" name="surname"></input></p>
	<p>Email: <input type="text" name="email"></input></p>
	<p>Password: <input type="password" name="password"></input></p>
	<p>Luogo di nascita: <input type="text" name="place_of_birth"></input></p>
	<p>Data di nascita: <input type="date" name="date_of_birth"></input></p>
	<p>Avatar: <input type="file" name="avatar"></input></p>
	<p>Biografia: <textarea cols="50" rows="10" name="biography"></textarea></p>
	<input type="submit"></input>
</form>