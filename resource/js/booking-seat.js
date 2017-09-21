$(document).ready(function(){
	$('.seat-map').click(checkSeats);
	function checkSeats(){
		if ($('.seat-map input:checked').length){
			$('#bookSeat').attr('disabled',null);
		}
		else{
			$('#bookSeat').attr('disabled','disabled');
		}
	}
	checkSeats();
});