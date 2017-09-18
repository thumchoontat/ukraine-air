<?php 
var_dump($_SERVER['SCRIPT_NAME']);
const APP_DIR = '/ukraine-air';
//error_reporting(0);

$filePath = str_replace(APP_DIR,'',$_SERVER['SCRIPT_NAME']);
// If .php extension is not found, add it in
if (!preg_match("(.php)",$filePath)){
	$filePath = preg_replace('(\/$)','',$filePath).'.php';
}
?>
<html>
<head>
	<?php include "/template/sources.php";?>
	<title></title>
</head>
<body>
	<?php include "template/header.php";?>
	<?php 
		if ($filePath == '/index.php'){
			//include 'view/home.php';
		}
		else if (file_exists($filePath)){
			echo 'file exists';
		}
		else{
			echo 'file not exists';
		}
	?>
	<?php include "template/footer.php" ?>
</body>
</html>