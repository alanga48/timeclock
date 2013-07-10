$(document).ready( function() {

	var url = document.createElement('a');
	url.href = location.href;
	console.log(url.hash); 
	$(url.hash).slideDown(500, 
		function() { $('<i class="icon-expand-alt"></i>').html('<i class="icon-collapse-alt"></i>') } 
	);

	$('.comment').click(function(e){
		e.preventDefault();
		href = $(this).attr('href');
		console.log(href);
		$(href).slideToggle();
		$(this).text($(this).text() == 'View Full Comment' ? 'Minimize' : 'View Full Comment');
		return false;
	})

});

