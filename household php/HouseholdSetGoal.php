<?php
	header('ConTent-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$id = $_POST["id"];
	$goalMoney = $_POST["goal"];
	$goalMoney = (int)$goalMoney;

	mysqli_query($con, "UPDATE HOUSEHOLD_USER SET goal = $goalMoney WHERE id = $id");

	$response = array();
	$response["success"] = true;

	echo json_encode($response);
?>