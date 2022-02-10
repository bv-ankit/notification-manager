jQuery(document).ready(function($) {

	$(document).on('click', '.close', function( ) {
		//this.parentElement.style.display = 'none';
		$(this).parent().parent().remove();
	});
});
