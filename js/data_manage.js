window.addEventListener('load', function () 
	{
		var base1 = '<li id="wp-admin-bar-';
		var base2 = '"><div class="ab-item ab-empty-item"><div style="background-color:#F2F3F5; color:black; border:0px solid #3c434a; border-left-width:3px; padding:0px 25px 0px 5px !important; border-left-color:';
		var base3 = '<span class="close_button notice-dismiss" style="cursor:pointer; position:absolute; top:50%; right:1%; font-size:x-large; color:#808080; transform: translate(0%, -50%);"></span></div><div></li>';
		var exc = document.getElementById("wp-admin-bar-notification-manager-default");
		var b_colors = ["#db3236", "#3cba54", "#f4c20d", "#4885ed", "black"];
		var noti_id = 1;
		var data = [];

		// 0:error 1:success 2:warning 3:info 4:misc

		var t4 = ["notice-error", "notice-success", "notice-warning","notice-info"];
		var f = [];
		
		//error
		var eles = document.getElementsByClassName('error');
		for(var i=0; i<eles.length; i++)
		{
			if(!(eles[i].classList).contains("hidden"))
			{
				temp = eles[i].classList.contains("is-dismissible") ? base3 : '';
				exc.innerHTML += base1+noti_id+base2+b_colors[0]+'">'+eles[i].innerHTML+temp;
				noti_id++;
			}
		}
		
		var eles = document.getElementsByClassName('notice');
		//notice-error
		for(var i=0; i<eles.length; i++)
		{
			if(!(eles[i].classList).contains("hidden"))
			{
				temp = eles[i].classList.contains("is-dismissible") ? base3 : '';
				if(eles[i].classList.contains(t4[0]))
				{
					f.push(i);
					exc.innerHTML += base1+noti_id+base2+b_colors[0]+'">'+eles[i].innerHTML+temp;
					noti_id++;
				}
			}
		}

		//updated
                var el = document.getElementsByClassName('updated');
                for(var i=0; i<el.length; i++)
                {
                        if(!(el[i].classList).contains("hidden"))
                        {
                                temp = el[i].classList.contains("is-dismissible") ? base3 : '';
                                exc.innerHTML += base1+noti_id+base2+b_colors[1]+'">'+el[i].innerHTML+temp;
                                noti_id++;
                        }
                }


		//notice-success, notice-warning, notice-info
		for(var j=1; j<4; j++)
		{
			for(var i=0; i<eles.length; i++)
			{
				if(!(eles[i].classList).contains("hidden"))
				{
					temp = eles[i].classList.contains("is-dismissible") ? base3 : '';
					if(eles[i].classList.contains(t4[j]))
					{
						f.push(i);
						exc.innerHTML += base1+noti_id+base2+b_colors[j]+'">'+eles[i].innerHTML+temp;
						noti_id++;
					}
				}
			}
		}

		//misc
		for(var i=0; i<eles.length; i++)
		{
			if(!(f.includes(i) || (eles[i].classList).contains("hidden")))
			{
				temp = eles[i].classList.contains("is-dismissible") ? base3 : '';
				exc.innerHTML += base1 + noti_id + base2 + b_colors[4] + '">' + eles[i].innerHTML + temp;
				noti_id++;
			}
		}
	}
)
