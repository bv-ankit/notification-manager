jQuery(document).ready(function($) {

    $(document).on('click', '#sticky_an .notice-dismiss', function( event ) {

        data = {
            action : 'display_dismissible_admin_notice',
        };

        $.post(ajaxurl, data, function (response) {
            console.log(response, 'DONE!');
        });
    });
});

//const obj = {name: "John", age: 30, city: "New York"};

/*
var myJSON = JSON.stringify(obj);
request= new XMLHttpRequest()
request.open("POST", '../wp-content/plugins/show_notices/show_notices.php', true)
request.setRequestHeader("Content-type", "application/json")
request.send(myJSON)
*/





/*
window.addEventListener('load', function()
	{
		var data = document.getElementsByClassName('notice');
		console.log(data);
		console.log(data.length);
		<script id="blockOfStuff" type="text/html">
    			Here is some random text.
    			<h1>Including HTML markup</h1>
    			And quotes too, or as one man said, "These are quotes, but these are quotes too."<br><br>
		</script>
		var div = document.createElement('div');
		div.setAttribute('class', 'someClass');
		div.innerHTML = document.getElementById('blockOfStuff').innerHTML;
	}
)

*/
