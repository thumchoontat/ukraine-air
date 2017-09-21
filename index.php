<?php 
// error_reporting(0);
session_start();
require_once('model/class/message.php');
$message = new Message();
// Page directory cleanup
require_once('directory.php');

// Checks for session validity
require_once('session.php');

// Include page functions if exists
if ($dirExists && file_exists($pageDir.'core.php')){
	include $pageDir.'core.php';
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>
		<?php 
			if (defined('PAGE_TITLE')){
				echo PAGE_TITLE;
			}
			else{
				echo 'UIA';
			}
		?>
	</title>
	<?php include "/template/sources.php";?>
	<?php 
		if ($dirExists && file_exists($pageDir.'resource.php')){
			include $pageDir.'resource.php';
		}
	?>
	
	<?php if ($message->hasMessage()) {?>
		<script>
		$(document).ready(function(){
			alert('<?php echo $message->getContent(); ?>','<?php echo $message->getType(); ?>');
		});
		</script>
	<?php } ?>
</head>
<body>
	<?php include "template/header.php";?>
	
	<?php if (!preg_match('/(index|home)/',$pageDir)){ ?>
	<div class="page-title"><?php 
			if (defined('PAGE_TITLE')){
				echo PAGE_TITLE;
			}
			else{
				echo 'UIA';
			}
	?></div>
	<?php }// END check index page ?>
	
	<?php 
		if ($dirExists){
			if (file_exists($pageDir.'content.php')){
				include $pageDir.'content.php';
			}
			else{
				include '/template/content.php';
			}
		}
		else{
			$errorCode = 404;
			$errorMessage = '"'.preg_replace('/^pages\//','',$pageDir).'" not found.';
			include '/pages/error/content.php';
		}
	?>
	<?php include "template/footer.php" ?>
</body>
</html>
