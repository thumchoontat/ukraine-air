<?php 
	if ($validUser){
		define('PAGE_TITLE', 'Ticket List');
	}
	else{
		define('PAGE_TITLE', 'UIA');
	}
	
	require_once('model/function/ticket.php');
	
	$bookFrom = date('Y-m-d');
	$bookTo = date('Y-m-d');
	$flightFrom = date('Y-m-d');
	$flightTo = date('Y-m-d');
	
	if (array_key_exists('book-from', $_REQUEST)){
		$bookFrom = $_REQUEST['book-from'];
	}
	if (array_key_exists('book-to', $_REQUEST)){
		$bookTo = $_REQUEST['book-to'];
	}
	if (array_key_exists('flight-from', $_REQUEST)){
		$flightFrom = $_REQUEST['flight-from'];
	}
	if (array_key_exists('flight-from', $_REQUEST)){
		$flightTo = $_REQUEST['flight-to'];
	}
?>