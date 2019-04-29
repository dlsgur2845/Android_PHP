<?php
	header('Content-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$userID = $_GET["userID"];

	$result = mysqli_query($con, "SELECT userMoney, goal FROM HOUSEHOLD_USER WHERE userID = '$userID'");

	$response = array();

	while($row = mysqli_fetch_row($result)){
		$response["userMoney"] = $row[0];
		$response["goal"] = $row[1];
	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
	mysqli_close($con);
?>