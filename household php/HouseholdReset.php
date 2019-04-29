<?php
	header('Content-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$id = $_POST["id"];

	mysqli_query($con, "DELETE FROM HOUSEHOLD_MONEY WHERE id = $id");
	mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userMoney = 0 where id = $id");
	mysqli_query($con, "UPDATE HOUSEHOLD_USER SET goal = 0 where id = $id");

	$response=array();
	$response["success"] = true;

	echo json_encode($response);
?>