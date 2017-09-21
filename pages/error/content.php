<div style="padding: 10px">
	<div class="jumbotron error">
		<h1>Error <?php echo $errorCode; ?></h1>
		<h2><?php echo $errorMessage; ?></h2>
	</div>
</div>
<?php 
	unset($_SESSION['errorCode']);
	unset($_SESSION['errorMessage']);
?>