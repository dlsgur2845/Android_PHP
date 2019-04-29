<?php
	header('Content-Type: text/html; charset=UTF-8');
	$con = mysqli_connect("localhost", "dlsgur2845", "123qwert", "dlsgur2845");
	mysqli_query($con, "SET NAMES utf8");

	$id = $_POST["id"];
	$userID = $_POST["userID"];
	$originalPw = $_POST["originalPw"];
	$newPw = $_POST["newPw"];
	$newName = $_POST["newName"];
	$newAge = $_POST["newAge"];
	$newMail = $_POST["newMail"];
	$withdrawal = $_POST["withdrawal"];
	$withdrawal = (int)$withdrawal;

	$response = array();
	$response["success"] = false;

	if($withdrawal == 1){
		$statement = mysqli_prepare($con, "SELECT userID FROM HOUSEHOLD_USER WHERE userID = ? AND userPassword = ? AND userName = ? AND userAge = ? AND userMail = ?");
		mysqli_stmt_bind_param($statement, "sssss", $userID, $originalPw, $newName, $newAge, $newMail);
		mysqli_stmt_execute($statement);
		mysqli_stmt_store_result($statement);
		mysqli_stmt_bind_result($statement, $userID);

		while(mysqli_stmt_fetch($statement)){
			mysqli_query($con, "DELETE FROM HOUSEHOLD_MONEY WHERE id = $id");
			mysqli_query($con, "DELETE FROM HOUSEHOLD_USER WHERE id = $id");
			$response["success"] = true;
		}
	}
	else{
		$statement = mysqli_prepare($con, "SELECT userID FROM HOUSEHOLD_USER WHERE userID = ? AND userPassword = ?");
		mysqli_stmt_bind_param($statement, "ss", $userID, $originalPw);
		mysqli_stmt_execute($statement);
		mysqli_stmt_store_result($statement);
		mysqli_stmt_bind_result($statement, $userID);

		while(mysqli_stmt_fetch($statement)){
			if(strcmp($newPw, "NONE")){
				mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userPassword = '$newPw' WHERE id = $id");
			}
			mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userName = '$newName' WHERE id = $id");
			mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userAge = '$newAge' WHERE id = $id");
			mysqli_query($con, "UPDATE HOUSEHOLD_USER SET userMail = '$newMail' WHERE id = $id");
			$response["success"] = true;
		}
	}

	echo json_encode($response);
?>