<?php 
	$pageDir = str_replace('?'.$_SERVER['QUERY_STRING'],'','pages'.$_SERVER['REQUEST_URI']);

	// Add trailing slash if absent
	if (!preg_match('(\/$)',$pageDir)){
		$pageDir .= '/';
	}

	// Redirect home and index to home page, with or without trailing slash
	if (preg_match('/pages\/(index|home|)(\/|)$/',$pageDir)){
		$pageDir = 'pages/home/';
	}

	// perform logout action
	else if (preg_match('/pages\/logout(\/|)$/', $pageDir)){
		session_unset();
		session_destroy();
		header('Location: /');
	}

	$dirExists = file_exists($pageDir);
?>