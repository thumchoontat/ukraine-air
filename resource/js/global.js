$(document).ready(function(){
	// Add glyphicon after external links
	$('a[href^="http"]').click(function(event){
		if (this.getAttribute('target') !== '_blank'){
			this.setAttribute('target','_blank');
		}
	});
});