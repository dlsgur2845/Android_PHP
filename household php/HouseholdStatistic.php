<?php
	header('Content-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$id = $_POST["id"];
	$chooseButton = $_POST["chooseButton"];

	if(!strcmp($chooseButton, "0")){
		$Dyear = date("Y");
		$Dmonth = date("m");
		$Ddate = date("d");
		$result = mysqli_query($con, "SELECT money, summary, Dyear, Dmonth, Ddate, Longitude, Latitude FROM HOUSEHOLD_MONEY WHERE id = $id AND Dyear = $Dyear AND Dmonth = $Dmonth AND Ddate = $Ddate ORDER BY currentTime DESC");
	}
	if(!strcmp($chooseButton, "1")){
		$today = getdate();
		$sday = getdate(mktime(0,0,0,$today['mon'],$today['mday']-$today['wday'],$today['year']));

		$i=6;
		$response = array();
		while($i>=0){
			$Ddate = date("Y-m-d",mktime(0,0,0,$sday['mon'],$sday['mday']+$i,$sday['year']));
			$Ddate = (string)$Ddate;
			$Ddate = explode("-", $Ddate);
			$result = mysqli_query($con,  "SELECT money, summary, Dyear, Dmonth, Ddate, Longitude, Latitude FROM HOUSEHOLD_MONEY WHERE id = $id AND Dyear = $Ddate[0] AND Dmonth = $Ddate[1] AND Ddate = $Ddate[2] ORDER BY currentTime DESC");

			while($row = mysqli_fetch_array($result)){
				array_push($response, array("money"=>$row[0], "summary"=>$row[1], "Dyear"=>$row[2], "Dmonth"=>$row[3], "Ddate"=>$row[4], "Longitude"=>$row[5], "Latitude"=>$row[6]));
			}
			$i--;

		}
		echo json_encode(array("response"=>$response), JSON_UNESCAPED_UNICODE);
		return;
	}

	else if(!strcmp($chooseButton, "2")){
		$Dyear = date("Y");
		$Dmonth = date("m");
		$result = mysqli_query($con, "SELECT money, summary, Dyear, Dmonth, Ddate, Longitude, Latitude FROM HOUSEHOLD_MONEY WHERE id = $id AND Dyear = $Dyear AND Dmonth = $Dmonth ORDER BY currentTime DESC");
	}
	else if(!strcmp($chooseButton, "3")){
		$Dyear = $_POST["Dyear"];
		$Dmonth = $_POST["Dmonth"];
		$Ddate = $_POST["Ddate"];

		if(!strcmp($Dmonth, "전체")){
			$result = mysqli_query($con, "SELECT money, summary, Dyear, Dmonth, Ddate, Longitude, Latitude FROM HOUSEHOLD_MONEY WHERE id = $id AND Dyear = $Dyear ORDER BY currentTime DESC");
		}
		else if(!strcmp($Ddate, "전체")){
			$result = mysqli_query($con, "SELECT money, summary, Dyear, Dmonth, Ddate, Longitude, Latitude FROM HOUSEHOLD_MONEY WHERE id = $id AND Dyear = $Dyear AND Dmonth = $Dmonth ORDER BY currentTime DESC");
		}
		else{
			$result = mysqli_query($con, "SELECT money, summary, Dyear, Dmonth, Ddate, Longitude, Latitude FROM HOUSEHOLD_MONEY WHERE id = $id AND Dyear = $Dyear AND Dmonth = $Dmonth AND Ddate = $Ddate ORDER BY currentTime DESC");
		}
	}

	$response = array();
	while($row = mysqli_fetch_array($result)){
		array_push($response, array("money"=>$row[0], "summary"=>$row[1], "Dyear"=>$row[2], "Dmonth"=>$row[3], "Ddate"=>$row[4], "Longitude"=>$row[5], "Latitude"=>$row[6]));
	}

	echo json_encode(array("response"=>$response), JSON_UNESCAPED_UNICODE);
?>