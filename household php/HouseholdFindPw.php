<?php
	header('Content-Type: text/html; charset=UTF-8');
	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$userID = $_POST["userID"];
	$userPw = $_POST["userPw"];

	$response = array();

	$statement = mysqli_prepare($con, "UPDATE HOUSEHOLD_USER SET userPassword = ? WHERE userID = ?");
	mysqli_stmt_bind_param($statement, "ss", $userPw, $userID);
	mysqli_stmt_execute($statement);
	$response["success"] = true;

	echo json_encode($response);
?>