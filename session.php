<?php 
	require_once('model/class/dbconnector.php');
	$validUser = call_user_func(function(){
		if (array_key_exists('username',$_SESSION)){
			$conn = DBConnector::getInstance()->getConn();
			$stmt = $conn->prepare('SELECT `sessionID` FROM `user` WHERE `username` = ?');
			$stmt->bind_param("s",$_SESSION['username']);
			$stmt->execute();
			$result = $stmt->get_result();
			$validUser = ($result->fetch_assoc()['sessionID'] == session_id());
			return $validUser;
		}
		return false;
	});
?>