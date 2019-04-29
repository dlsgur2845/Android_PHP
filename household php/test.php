<?php
	header('Content-Type: text/html; charset=UTF-8');
	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userName = 'inhyuk' WHERE id = 20180517160851");
	mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userAge = 19960216 WHERE id = 20180517160851");
	mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userMail = dlsgur2845@daum.net WHERE id = 20180517160851");

	echo json_encode($response);
?>