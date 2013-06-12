$(document).ready( function() {

	var url = document.createElement('a');
	url.href = location.href;
	console.log(url.hash); 
	$(url.hash).slideDown(500);

});

