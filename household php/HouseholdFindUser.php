<?php
	header('Content-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$userID = $_POST["userID"];
	$userName = $_POST["userName"];
	$userMail = $_POST["userMail"];
	$mode = $_POST["mode"];

	if(!strcmp($mode, "ID")){
		$statement = mysqli_prepare($con, "SELECT userID FROM HOUSEHOLD_USER WHERE userName = ? AND userMail = ?");
		mysqli_stmt_bind_param($statement, "ss", $userName, $userMail);
		mysqli_stmt_execute($statement);
	}
	else{
		$statement = mysqli_prepare($con, "SELECT userID FROM HOUSEHOLD_USER WHERE userID = ? AND userMail = ?");
		mysqli_stmt_bind_param($statement, "ss", $userID, $userMail);
		mysqli_stmt_execute($statement);
	}

	mysqli_stmt_store_result($statement);
	mysqli_stmt_bind_result($statement, $userID);

	$response = array();
	$response["success"] = false;

	while(mysqli_stmt_fetch($statement)){
		$response["userID"] = $userID;
		$response["success"] = true;
	}

	echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>