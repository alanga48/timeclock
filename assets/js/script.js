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
	

});

	
