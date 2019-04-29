<?php
	header('Content-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$result = mysqli_query($con, "SELECT * FROM HOUSEHOLD_NOTICE ORDER BY noticeDate DESC;");
	$response = array();

	while($row = mysqli_fetch_array($result)){
		array_push($response, array("noticeContent"=>$row[0], "noticeName"=>$row[1], "noticeDate"=>$row[2]));
	}

	echo json_encode(array("response"=>$response), JSON_UNESCAPED_UNICODE);
?>