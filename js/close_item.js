jQuery(document).ready(function($) {

	$(document).on('click', '.close', function( ) {
		$(this).parent().parent().remove();
	});
});

