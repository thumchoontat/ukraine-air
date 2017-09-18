<?php 
$resourceDir = '/resource';
$bootstrapDir = $resourceDir . '/bootstrap-3.3.7';
echo "
	<script src=\"$resourceDir/jquery/jquery.min.js\"></script>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"$bootstrapDir/css/bootstrap.css\" media=\"all\">
	<script src=\"$bootstrapDir/js/bootstrap.min.js\"></script>
	<link rel=\"stylesheet\"type=\"text/css\" href=\"$resourceDir/css/global.css\"/>
	<script src=\"$resourceDir/js/global.js\"></script>
";
?>