<?php 
	if ($validUser){
		header('Location: index',301);
	}
	const PAGE_TITLE = 'Register';
	require_once('model/class/user.php');
	
	$user = new User($_REQUEST);
	if ($user->valid()){
		if ($user->registerUser()){
			$message->set('Registration successful','success');
			$user->clear();
		}
		else{
			$message->set('Username "'.$user->getUsername().'" has been used.','warning');
		}
	}
?>
