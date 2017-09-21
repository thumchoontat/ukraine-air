<?php 
$errorCode = null;
$errorMessage = null;
if (isset($_SESSION['errorCode']) || isset($_SESSION['errorMessage'])){
	if (isset($_SESSION['errorCode'])){
		$errorCode = $_SESSION['errorCode'];
	}
	if (isset($_SESSION['errorMessage'])){
		$errorMessage = $_SESSION['errorMessage'];
	}
}
else{
	header('Location: /');
}
?>