$(document).ready(function(){
	$('input[type="text"]:not(:disabled)').keyup(checkInput);
	
	function checkInput(){
		var inputs = $('input[type="text"]:not(:disabled)');
		
		for (var i = 0; i < inputs.length; i++){
			if (!inputs[i].value){
				$('#bookTicket').attr('disabled', 'disabled');
				return;
			}
		}
		
		if (!inputs.length){
			$('#bookTicket').attr('disabled', 'disabled');
		}
		else{
			$('#bookTicket').attr('disabled', null);
		}
	}
	
	checkInput();
	
	$('input[data-toggle="popover"]').popover({
		container: 'body', trigger: 'focus'
	});
});