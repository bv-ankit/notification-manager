jQuery(document).ready(function($) {
    $('.close_button').on('click', function() {
	    $(this).parent().parent().remove();
    });
});
