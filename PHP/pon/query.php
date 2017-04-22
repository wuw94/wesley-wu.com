<?php
	function query($query)
	{
		$to_return = "";

		$mysqli = new mysqli("localhost", "pon-user", "7vsv76olpca", "pon");
		$to_return .= "MySQL: " . ((!$mysqli->connect_errno) ? "Success" : "Failed\n(" . $mysqli->connect_errno.") " . $mysqli->connect_error) . "\n";

		$result = $mysqli->query($query);
		$mysqli->close();
		$to_return .= "Query: " . (($result) ? $result->num_rows . " rows\n" : "Failed") . "\n";
		
		for ($row = 0; $row < $result->num_rows; $row++)
		{
			$current_row = $result->fetch_assoc();
			$num_columns = count(array_keys($current_row));
			for ($current_column = 0; $current_column < $num_columns; $current_column++)
				$to_return .= ($current_column == 0 ? "" : " ") . array_keys($current_row)[$current_column] . "=" . $current_row[array_keys($current_row)[$current_column]] . "\n";
		}

		return $to_return;
	}
?>
