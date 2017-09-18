$(document).ready(function(){
	// load skill level animation
	
	var paths = $('path');
	for (var i = 0; i < paths.length; i++){
		var style = document.createElement('style');
		var path = paths[i];
		var svg = path.parentNode;
		var skillLevel = $(svg).parent().find('.skill-level').text();
		var length = paths[i].getTotalLength();
		var drawPercentage = (length * (1-((parseFloat(skillLevel) || 0) / 100)));
		
		path.style.strokeDasharray = length;
		path.style.strokeDashoffset = drawPercentage;
		
		var animationName = 'skill-' + i.toString();
		style.innerHTML = '@keyframes ' + animationName + '{' +
		  'from{stroke-dashoffset:' + length + ';}' +
		  'to{stroke-dashoffset:' + drawPercentage + ';}' +
		  '}';
		  document.head.appendChild(style);
		  
		path.style.animation = animationName + ' 0.7s';
		path.addEventListener('animationend',function(){
			// style.remove();
		});
		
	}
});