$(document).ready( function() {

	var url = document.createElement('a');
	url.href = location.href;
	console.log(url.hash); 
	$(url.hash).slideDown(500, 
		function() { $('<i class="icon-expand-alt"></i>').html('<i class="icon-collapse-alt"></i>') } 
	);

});

// '<i class="icon-expand-alt icon-large"></i>'

