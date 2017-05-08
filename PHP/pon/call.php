<?php
	include "functions.php";
	$secretKey="485AD1953719843C46CE785ECBF74";

	$data = $_GET;
	unset($data["hash"], $data["function"]);

	$mysqli = new mysqli("localhost", "pon-user", "7vsv76olpca", "pon");
	foreach (array_keys($data) as $key)
	{
		$data[$key] = $mysqli->real_escape_string($data[$key]);
		$real_hash .= $data[$key];
	}
	$mysqli->close();

	$real_hash = md5($real_hash . $secretKey);
	if ($real_hash == $_GET["hash"])
	{
		$args = array();
		$args[] = $_GET["function"];
		foreach (array_keys($data) as $key)
			$args[] = $data[$key];
		call($args);
	}
	exit();
?>
