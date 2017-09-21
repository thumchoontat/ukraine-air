$(document).ready(function(){
	$('button.clear').click(function(event){
		event.preventDefault();
		$('input[type="text"],input[type="password"]').val(null);
	});
	
	$('[data-toggle="popover"]').popover({
		container: 'body',
		trigger: 'focus'
	});
});