<?php 
	//CREATE DATABASE IF NOT EXISTS day22 CHARACTER SET utf8 COLLATE utf8_general_ci
	/*
		CREATE TABLE  categories
		(
			id INT(11) AUTO_INCREMENT,
		    name VARCHAR (255) NOT NULL,
		    description TEXT DEFAULT NULL,
		    avatar VARCHAR(255),
		    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		    PRIMARY KEY (id)
		);
	*/
	// 5 section for connect database
		const DB_HOST = 'localhost';
		const DB_USERNAME='root';
		const DB_PASSWORD='';
		const DB_NAME ='day22';
		const DB_PORT = 3306;

	$conn = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME,DB_PORT);

		if(!$conn)
		{
			die('connect false'.mysqli_connect_error());
		}

		// echo "<h2>ket noi thanh cong </h2>";

 ?>