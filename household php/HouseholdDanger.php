<?php
	header('Content-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$id = $_POST["id"];

	$result = mysqli_query($con, "SELECT * FROM HOUSEHOLD_MONEY WHERE id = $id");
	$response = array();

	while($row = mysqli_fetch_array($result)){
		array_push($response, array("id"=>$row[0], "money"=>$row[1], "summary"=>$row[2],
					"Dyear"=>$row[3], "Dmonth"=>$row[4],
					"Ddate"=>$row[5], "currentTime"=>$row[6],
					"Latitude"=>$row[7], "Longitude"=>$row[8]));
	}

	echo json_encode(array("response"=>$response), JSON_UNESCAPED_UNICODE);
?>