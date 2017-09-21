<?php 
	/* Seat core */

	if (isset($validUser) && !$validUser){
		$_SESSION['errorCode'] = 403;
		$_SESSION['errorMessage'] = 'Forbidden access on "'.preg_replace('/^pages\//','',$pageDir).'"';
		header('Location: /error');
		exit();
	}
	
	require_once('model/function/flight.php');
	require_once('model/function/seat.php');
	
	const PAGE_TITLE = 'Select Seat';
	
	$flightID = null;
	
	if (array_key_exists('flightID', $_REQUEST)){
		$flightID = $_REQUEST['flightID'];
	}
	else{
		header('Location: /booking', 301);
	}
?>