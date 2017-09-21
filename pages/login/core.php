<?php 
	if ($validUser){
		header('Location: index',301);
	}
	
	require_once('model/class/user.php');
	
	const PAGE_TITLE = 'Login';
	
	$user = new User($_REQUEST);
	
	if (array_key_exists('username',$_REQUEST) || array_key_exists('password',$_REQUEST)){
		if ($user->login($message)){
			header('Location: index', 301);
		}
	}// END array key exists
?>