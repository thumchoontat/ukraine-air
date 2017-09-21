<?php 
	require_once('model/class/dbconnector.php');
	
	function getTickets($bookFrom, $bookTo, $flightFrom, $flightTo, $username){
		$db = DBConnector::getInstance();
		$conn = $db->getConn();
		$stmt = $conn->prepare("
			SELECT
				DATE(`booking`.`bookingDate`) AS 'bookingDate',
				`ticket`.`passengerName`,
				CONCAT(`ticket`.`seatID`, '-' ,`ticket`.`seatCol`) AS 'seatID',
				CONCAT(`sourceAirport`.`cityName`, ' (', `sourceAirport`.`airportID`, ')') AS 'source',
				CONCAT(`destinationAirport`.`cityName`, ' (', `destinationAirport`.`airportID`, ')') AS 'destination',
				`flight`.`departureTime`,
				`flight`.`arrivalTime`
			FROM `booking`
				INNER JOIN `ticket` ON `ticket`.`bookingID` = `booking`.`bookingID`
				INNER JOIN `flight` ON `flight`.`flightID` = `ticket`.`flightID`
				INNER JOIN `airport` AS `sourceAirport` ON `sourceAirport`.`airportID` = `flight`.`source`
				INNER JOIN `airport` AS `destinationAirport` ON `destinationAirport`.`airportID` = `flight`.`destination`
			WHERE
				`booking`.`username` = ?
				AND
				DATE(`booking`.`bookingDate`) >= ?
				AND
				DATE(`booking`.`bookingDate`) <= ?
				AND
				DATE(`flight`.`departureTime`) >= ?
				AND
				DATE(`flight`.`departureTime`) <= ?
		");
		$stmt->bind_param("sssss", $username, $bookFrom, $bookTo, $flightFrom, $flightTo);
		$stmt->execute();
		return $stmt->get_result();
	}// function getTickets
	
	function bookTickets($passengers = array(), $seatIDs, $cols, $flightID, $username){
		$db = DBConnector::getInstance();
		$conn = $db->getConn();
		
		/* Create booking record */
		$stmt = $conn->prepare("
			INSERT INTO `booking` (
				`bookingDate`,
				`username`
			)
			VALUES (
				CURRENT_TIMESTAMP,
				?
			)
		");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$bookingID = $stmt->insert_id;
		
		/* Insert ticket record */
		for ($i = 0; $i < count($passengers); $i++){
			$stmt = $conn->prepare("
				INSERT INTO `ticket` (
					`passengerName`,
					`seatID`,
					`seatCol`,
					`flightID`,
					`bookingID`
				)
				(
					SELECT
						?,
						`seatID`,
						`col`,
						`flightID`,
						?
					FROM `seat`
					WHERE
						`seatID` = ?
						AND
						`col` = ?
						AND
						`flightID`= ?
						AND
						`lockBy` = ?
				)
			");
			$stmt->bind_param(
				"siisis", 
				$passengers[$i], 
				$bookingID, 
				$seatIDs[$i], 
				$cols[$i], 
				$flightID, 
				$username
			);
			
			if ($stmt->execute() === false){
				/* Delete booking with cascading effect on tickets */
				$delStmt = $conn->prepare("
					DELETE FROM `booking`
					WHERE
						`bookingID` = ?
						AND
						`username` = ?
				");
				$delStmt->bind_param("is", $bookingID, $username);
				$delStmt->execute();
				
				/* Unlock seats locked by current user */
				$unlockStmt = $conn->prepare("
					UPDATE `seat`
					SET
						`lockBy` = NULL
					WHERE
						`lockBy` = ?
				");
				$unlockStmt->bind_param("s", $username);
				$unlockStmt->execute();
				
				return false;
			}// END if fails to enter ticket record
		}//END ticket record creation loop
		return true;
	}// function bookTickets
?>