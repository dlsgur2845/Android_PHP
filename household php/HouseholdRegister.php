<?php
	header('Content-Type: text/html; charset=UTF-8');
	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$id = date("YmdHis");
	$userID = $_POST["userID"];
	$userPassword = $_POST["userPassword"];
	$userName = $_POST["userName"];
	$userAge = $_POST["userAge"];
	$userGender = $_POST["userGender"];
	$userMail = $_POST["userMail"];
	$userMoney = 0;
	$goal = 0;

	$statement = mysqli_prepare($con, "INSERT INTO HOUSEHOLD_USER VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($statement, "sssssssii", $id , $userID, $userPassword, $userName, $userAge, $userGender, $userMail, $userMoney, $goal);
	mysqli_stmt_execute($statement);

	$response = array();
	$response["success"] = true;

	echo json_encode($response);
?>