$(document).ready(function(){
	$('#searchFlight').click(function(){
		$('#searchForm').submit();
	});
	
	$('table tbody tr').click(function(){
		$(this).find('form').submit();
	});
});