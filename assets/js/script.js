$(document).ready( function() {

	$('.modal_popup').colorbox({
		inline: true,
		onCleanup: function(){ 
			$('label.invalid').remove();
		}

	})

	$(".datetimepicker").datetimepicker();


	$('.validate').each( function() {
		$(this).validate({
			errorClass: "invalid",
			messages: {
				first_name: "A first name is required",
				last_name: "A last name is required",
				username: "A username is required",
				password: "A password is required"
			},
			errorPlacement: function(error,element) {
				element.before( error );
				$.colorbox.resize();
			}

		})
	})

	$('.clear').click( function() {

		$(this).parent().find('.clearable').val('');

	})

	$('.details_box').hide();


	$('.details').click(function (e) {
		e.preventDefault();
		href = $(this).attr('href');
		console.log(href);

		if ( $(href).is(":visible") ) {
			$(this).find('i').removeClass('icon-collapse').addClass('icon-expand');
		} else {
			$(this).find('i').removeClass('icon-expand').addClass('icon-collapse');
		}


		$(href).slideToggle(200, function() { 
			//$('i').removeClass('icon-expand-alt').addClass('icon-collapse-alt');
		});
	})


	
});

// function() { $('<i class="icon-expand-alt"></i>').html('<i class="icon-collapse-alt"></i>') } 