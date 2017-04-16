<?php
	// Display all errors that appear
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	echo "Trying SQL connection...\n";
	$mysqli = new mysqli("localhost", "pon-user", "7vsv76olpca", "pon");

	if (mysqli_connect_errno())
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	echo "SQL connection established\n\n";


	// Strings must be escaped to prevent SQL injection attack. 
	$name = $mysqli->real_escape_string($_GET['name']);
	$password = $mysqli->real_escape_string($_GET['password']);
	$email = $mysqli->real_escape_string($_GET['email']);
	$hash = $_GET['hash'];
 
	$secretKey="mySecretKey"; # Change this value to match the value stored in the client javascript below

	$real_hash = md5($name . $password . $email . $secretKey);

	echo "Checking if hashes match...\n";

	if($real_hash == $hash)
	{
		echo "Hashes match. Performing query...\n";
		$result = mysqli_query($mysqli, "INSERT INTO user VALUES (1, '$name', '$password', '$email');");
		echo "Query completed. But was it a success?\n";
        }
	else
	{
		echo "Hashes didnt match. Aborting query\n";
	}
?>
