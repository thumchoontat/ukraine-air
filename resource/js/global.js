(function(){
	$(document).ready(function(){
		// Add glyphicon after external links
		$('a[href^="http"]').click(function(event){
			if (this.getAttribute('target') !== '_blank'){
				this.setAttribute('target','_blank');
			}
		});
		
		// Load custom alerts
		if (!window.native){
			window.native = {};
		}
		window.native.alert = window.alert;
		window.alert = function(text, type){
			var alertContainer = document.createElement('div');
			alertContainer.classList.add('alert');
			alertContainer.style.wordWrap = 'break-word';
			alertContainer.style.width = '90%';
			alertContainer.style.position = 'absolute';
			alertContainer.style.top = '20px';
			alertContainer.style.left = '5%';
			switch (type){
				case 'success':
					alertContainer.classList.add('alert-success');
					break;
					
				case 'info':
					alertContainer.classList.add('alert-info');
					break;
					
				case 'warning':
					alertContainer.classList.add('alert-warning');
					break;

				case 'danger':
					alertContainer.classList.add('alert-danger');
					break;
					
				default:
					alertContainer.classList.add('alert-success');
					break;
			}
			
			var alertRemover = document.createElement('span');
			alertRemover.classList.add('glyphicon','glyphicon-remove','close');
			alertRemover.addEventListener('click',alertRemoverEvent);
			alertContainer.appendChild(alertRemover);
			alertContainer.appendChild(document.createTextNode((text || '').toString()));
			
			document.body.appendChild(alertContainer);
			
			var dismissTimer = setTimeout(function(){
				alertRemoverEvent();
			},3000);
			
			function alertRemoverEvent(){
				clearTimeout(dismissTimer);
				alertRemover.removeEventListener('click',alertRemoverEvent);
				alertContainer.addEventListener('animationend',function(){
					alertContainer.parentNode.removeChild(alertContainer);
				});
				alertContainer.style.animation = 'alert-hide 0.5s linear';
			}
		}; //END windows.alert
	});
})();