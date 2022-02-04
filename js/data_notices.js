/*

jQuery(document).ready(function($){
	var test = '75'
	$.ajax({
		url: ajaxurl,
		data: {
			'action': 'my_plugin_ajax_store',
			'whatever': 'I am trying hardly!'
		}
	});
});
*/

window.addEventListener('load', function()
	{
		var notices = document.getElementsByClassName('notice');
		//console.log(notices[0].innerHTML);
		//console.log(notices.length);
		jQuery(document).ready(function($) {
    			var data = {
        			'action': 'my_plugin_ajax_store',
        			'whatever': notices[0].innerHTML
    			};
    			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			//jQuery.post(ajaxurl, data);
			
    			jQuery.post(ajaxurl, data, function(response) {
        			alert('Got this from the server: ' + response);
    			});
			
		});
	}	
)
