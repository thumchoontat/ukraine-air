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
	
	if (array_key_exists('book-from', $_REQUEST)){
		$bookFrom = $_REQUEST['book-from'];
	}
	if (array_key_exists('book-to', $_REQUEST)){
		$bookTo = $_REQUEST['book-to'];
	}
?>