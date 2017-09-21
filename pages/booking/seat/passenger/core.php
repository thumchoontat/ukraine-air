<?php 
	/* Passenger core */
	
	if (isset($validUser) && !$validUser){
		$_SESSION['errorCode'] = 403;
		$_SESSION['errorMessage'] = 'Forbidden access on "'.preg_replace('/^pages\//','',$pageDir).'"';
		header('Location: /error');
		exit();
	}
	
	require_once('model/function/flight.php');
	require_once('model/function/seat.php');
	require_once('model/function/ticket.php');
	
	const PAGE_TITLE = 'Passenger Details';
	
	$seats = null;
	$flightID = null;
	$passengers = array();
	
	if (array_key_exists('seats', $_REQUEST) && array_key_exists('flightID', $_REQUEST)){
		$seats = $_REQUEST['seats'];
		$flightID = (int)$_REQUEST['flightID'];
		
		if (array_key_exists('passenger', $_REQUEST)){
			$passengers = $_REQUEST['passenger'];
			$validPassengerNames = true;
			
			/* Checks every passenger name */
			if (count($passengers) === count($seats)){
				for ($i = 0; $i < count($passengers); $i++){
					if (!preg_match('/[a-zA-z. ]{3,100}/', $passengers[$i])){
						$validPassengerNames = false;
						break;
					}
				}
			}// END unmatch passengers and seats count
			
			if ($validPassengerNames){
				if (bookTickets($passengers, $_REQUEST['seat'], $_REQUEST['col'], $flightID, $_SESSION['username'])){
					header('Location: /');
				}
				else{
					$message->set('Some seats are reserved by other users. Please reselect seats.','danger');
				}
			}
			else{
				$message->set('Some passengers\\\' name entered are invalid.','danger');
			}
		}// END passenger request parameter exists
	}
	else{
		header('Location: /booking', 400);
	}
	
	if (!lockSeats($seats, $flightID, $_SESSION['username'])){
		$message->set('Some seats are reserved or locked by other user.','warning');
	}
?>