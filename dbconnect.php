<?php 
	//Set Database Parameters
	$servername	= "localhost";
	$username = "root";
	$password = "";
	$dbname = "homestaydb";

	//Create Database Connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	//Create Error if Connetion Failed
	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

 ?>