<?php 
	/* Booking core */
	
	if (isset($validUser) && !$validUser){
		$_SESSION['errorCode'] = 403;
		$_SESSION['errorMessage'] = 'Forbidden access on "'.preg_replace('/^pages\//','',$pageDir).'"';
		header('Location: /error');
		exit();
	}
	
	require_once('model/function/flight.php');
	
	const PAGE_TITLE = 'Select Flight';
	
	$queryDate = date('Y-m-d');
	
	if (array_key_exists('queryDate', $_REQUEST)){
		$queryDate = $_REQUEST['queryDate'];
	}
?>