<?php 
	require_once('model/class/dbconnector.php');
	
	function getFlights($departureDate = null){
		if ($departureDate === null || !is_string($departureDate)){
			$departureDate = date('Y-m-d');
		}
		$db = DBConnector::getInstance();
		$conn = $db->getConn();
		$stmt = $conn->prepare('
			SELECT 
				`flightID`,
				`airportSource`.`cityName` AS \'sourceCity\',
				`airportDestination`.`cityName` AS \'destinationCity\', 
				`source`, 
				`destination`,
				`departureTime`,
				`arrivalTime`,
				`fare`
			FROM `flight`
				INNER JOIN `airport` AS `airportSource` ON `source` = `airportSource`.`airportID`
				INNER JOIN `airport` AS `airportDestination` ON `destination` = `airportDestination`.`airportID`
			WHERE
				DATE(`departureTime`) = ?
			ORDER BY `departureTime` ASC
		');
		$stmt->bind_param("s", $departureDate);
		$stmt->execute();
		return $stmt->get_result();
	}// function getFlights
	
	function getFlightInfo($flightID = null){
		$db = DBConnector::getInstance();
		$conn = $db->getConn();
		$stmt = $conn->prepare('
			SELECT 
				`flightID`,
				`airportSource`.`cityName` AS \'sourceCity\',
				`airportDestination`.`cityName` AS \'destinationCity\', 
				`source`, 
				`destination`,
				`departureTime`,
				`arrivalTime`,
				`fare`
			FROM `flight`
				INNER JOIN `airport` AS `airportSource` ON `source` = `airportSource`.`airportID`
				INNER JOIN `airport` AS `airportDestination` ON `destination` = `airportDestination`.`airportID`
			WHERE
				`flightID` = ?
		');
		$stmt->bind_param("s", $flightID);
		$stmt->execute();
		return $stmt->get_result();
	} // function getFlightInfo
?>