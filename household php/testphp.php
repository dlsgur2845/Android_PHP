<?php
	header('Content-Type: text/html; charset=UTF-8');

	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

		$today = getdate();
		$sday = getdate(mktime(0,0,0,$today['mon'],$today['mday']-$today['wday'],$today['year']));

		$i=7;
		$response = array();
		while($i>0){ // 반대로 출력해야함
			$Ddate = date("Y-m-d",mktime(0,0,0,$sday['mon'],$sday['mday']+$i,$sday['year']));
			$Ddate = (string)$Ddate;
			$Ddate = explode("-", $Ddate);
			$result = mysqli_query($con,  "SELECT money, summary, Dyear, Dmonth, Ddate FROM HOUSEHOLD_MONEY WHERE Dyear = $Ddate[0] AND Dmonth = $Ddate[1] AND Ddate = $Ddate[2] ORDER BY currentTime DESC");

			while($row = mysqli_fetch_array($result)){
				array_push($response, array("money"=>$row[0], "summary"=>$row[1], "Dyear"=>$row[2], "Dmonth"=>$row[3], "Ddate"=>$row[4]));
			}
			$i--;

		}
		echo json_encode(array("response"=>$response), JSON_UNESCAPED_UNICODE);
?>