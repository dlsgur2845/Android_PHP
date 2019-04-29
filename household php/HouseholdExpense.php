<?php
	header('ConTent-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$id = $_POST["id"];
	$inputMoney = $_POST["inputMoney"];
	$inputMoney = (int)$inputMoney;
	$inputSummary = $_POST["summary"];
	$ownMoney = $_POST["ownMoney"];
	$ownMoney = (int)$ownMoney;
	$Longitude = $_POST["Longitude"];
	$Latitude = $_POST["Latitude"];
	$mode = $_POST["mode"];
	$Dyear = date("Y");
	$Dmonth = date("m");
	$Ddate = date("d");

	if(!strcmp($mode, "NORMAL")){
		$statement = mysqli_prepare($con, "INSERT INTO HOUSEHOLD_MONEY VALUES (?,?,?,?,?,?,CURRENT_TIMESTAMP,?,?)");
		mysqli_stmt_bind_param($statement, "sissssss", $id, $inputMoney, $inputSummary, $Dyear, $Dmonth, $Ddate, $Longitude, $Latitude);
		mysqli_stmt_execute($statement);
	}
	else{
		$Dyear = $_POST["Dyear"];
		$Dmonth = $_POST["Dmonth"];
		$Ddate = $_POST["Ddate"];

		$statement = mysqli_prepare($con, "INSERT INTO HOUSEHOLD_MONEY VALUES (?,?,?,?,?,?,CURRENT_TIMESTAMP,?,?)");
		mysqli_stmt_bind_param($statement, "sissssss", $id, $inputMoney, $inputSummary, $Dyear, $Dmonth, $Ddate, $Longitude, $Latitude);
		mysqli_stmt_execute($statement);
	}

	mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userMoney = $ownMoney WHERE id = $id");

	$response = array();
	$response["success"] = true;
	echo json_encode($response);
?>