<?php 
	require_once('model/class/dbconnector.php');
	
	function getSeats($flightID = 0){
		$db = DBConnector::getInstance();
		$conn = $db->getConn();
		
		/* Unlock seats locked by current user */
		$clearStmt = $conn->prepare("
			UPDATE `seat`
			SET
				`lockBy` = NULL
			WHERE
				`lockBy` = ?
		");
		$clearStmt->bind_param("s", $_SESSION['username']);
		$clearStmt->execute();
		
		$stmt = $conn->prepare("
			SELECT
				`seat`.`seatID`,
				`seat`.`col`,
				(TIMEDIFF(CURRENT_TIMESTAMP,`seat`.`lockTime`) <= '00:05:00' AND `seat`.`lockBy` IS NOT NULL) AS 'locked',
				(`ticket`.`bookingID` IS NULL) AS 'available' 
			FROM `seat`
				LEFT JOIN `ticket` ON `seat`.`seatID` = `ticket`.`seatID` AND `seat`.`col` = `ticket`.`seatCol`
			WHERE 
				`seat`.`flightID` = ?
			ORDER BY 
				`seat`.`seatID`, 
				`seat`.`col`
			ASC
		");
		$stmt->bind_param("i", $flightID);
		$stmt->execute();
		return $stmt->get_result();
	}// function getSeats
	
	function lockSeats($seats, $flightID, $username){
		$db = DBConnector::getInstance();
		$conn = $db->getConn();
		$success = true;
		
		foreach($seats as $seat){
			$stmt = $conn->prepare("
				UPDATE `seat`
				SET
					`lockBy` = ?
				WHERE
					(
						TIMEDIFF(CURRENT_TIMESTAMP, `lockTime`) > '00:05:00'
						OR
						`lockBy` IS NULL
					)
					AND
					(
						SELECT COUNT(`seatID`)
						FROM `ticket`
						WHERE 
							`flightID` = ?
							AND
							CONCAT(`seatID`,'-',`seatCol`) = ?
					) = 0
					AND
					CONCAT(`seatID`,'-',`col`) = ?
					AND
					`flightID` = ?
			");
			$stmt->bind_param("sissi", $username, $flightID, $seat, $seat, $flightID);
			$stmt->execute();
			if ($stmt->affected_rows === 0){
				$success = false;
			}
		}
		return $success;
	}
	
	function getLockedSeats($flightID, $username){
		$db = DBConnector::getInstance();
		$conn = $db->getConn();
		$stmt = $conn->prepare("
			SELECT 
				`seatID`, 
				`col`, 
				`flightID`
			FROM `seat`
			WHERE 
				`lockBy` = ?
				AND
				`flightID` = ?
		");
		$stmt->bind_param("si", $username, $flightID);
		$stmt->execute();
		return $stmt->get_result();
	}
?>