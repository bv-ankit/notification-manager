window.addEventListener('load', function () 
	{
		var eles = document.getElementsByClassName('notice');
		var data = {};
		for(var i=0; i<eles.length; i++){
			data[i] = {};
			data[i]['type'] = eles[i].classList;
			data[i]['data'] = eles[i].innerHTML;
		}
		//console.log(data);
		//var conv = 'data='+JSON.stringify(data);
		//console.log(conv);
		//document.getElementById("wnci-0").innerHTML = data[0]['data'];
		//document.getElementById("wnci-1").innerHTML = data[1]['data'];

	}
)
