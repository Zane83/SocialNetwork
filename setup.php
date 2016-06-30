<?php
	include("db.php");
	
	$query = "
	CREATE TABLE users(
		id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		email varchar(64) NOT NULL UNIQUE,
		password varchar(64) NOT NULL,
		name varchar(64) NOT NULL,
		surname varchar(64) NOT NULL,
		date_of_birth int NOT NULL,
		place_of_birth varchar(32) NOT NULL,
		avatar varchar(128) NOT NULL,
		biography varchar(512) NOT NULL
	);";
	
	if(!$mysqli->query($query))
		echo $mysqli->error;
	
	$query = "	
	CREATE TABLE friendships(
		id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		id_sender int NOT NULL,
		id_receiver int NOT NULL,
		date_of_request int NOT NULL,
		state boolean NOT NULL,
		
		foreign key(id_sender) references users(id),
		foreign key(id_receiver) references users(id)
	);";
	
	if(!$mysqli->query($query))
		echo $mysqli->error;
	
	$query = "
	CREATE TABLE posts(
		id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		id_user int NOT NULL,
		text varchar(1024) NOT NULL,
		date_of_publication date NOT NULL,
		
		foreign key(id_user) references users(id)
	);
	";
	
	if(!$mysqli->query($query))
		echo $mysqli->error;
	
	$query = "
	CREATE TABLE likes(
		id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		id_user int NOT NULL,
		id_post int NOT NULL,
		date int NOT NULL,
		
		foreign key(id_user) references users(id),
		foreign key(id_post) references posts(id)
	);
	";
	
	if(!$mysqli->query($query))
		echo $mysqli->error;
	
	$query = "
	CREATE TABLE comments(
		id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		id_user int NOT NULL,
		text varchar(256) NOT NULL,
		id_post int NOT NULL,
		date int NOT NULL,
		
		foreign key(id_user) references users(id),
		foreign key(id_post) references posts(id)
	);
	";
	
	if(!$mysqli->query($query))
		echo $mysqli->error;
	
	$query = "
	CREATE TABLE notifies(
		id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		id_user int NOT NULL,
		id_receiver int NOT NULL,
		id_post int NOT NULL,
		type varchar(16) NOT NULL,
		id_type int NOT NULL,
		viewed boolean NOT NULL,
		date int NOT NULL,
		
		foreign key(id_user) references users(id)
	);
	";
	
	if(!$mysqli->query($query))
		echo $mysqli->error;
	
	$query = "
	CREATE TABLE user_interests(
		id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
		id_1 int NOT NULL,
		id_2 int NOT NULL,
		level int NOT NULL,
		
		foreign key(id_1) references users(id),
		foreign key(id_2) references users(id)
	);";
	
	if(!$mysqli->query($query))
		echo $mysqli->error;
?>