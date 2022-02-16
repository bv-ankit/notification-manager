window.addEventListener('load', function () 
	{
		var toggle = 0;
		var noti_id = 1;
		var nm_container = document.querySelector("#nm_container");

		function nm_add_to_container(nm_notice)
		{
			if(toggle == 0)
			{
				document.querySelector('#nm_container h3').remove();
				toggle = 1;
			}
			
			var nm_container_div = '<div id="all_nm_'+noti_id+'"></div><br>';
			nm_container.innerHTML += nm_container_div;

			var temp = '#all_nm_'+noti_id;
			var nm_box = document.querySelector(temp);
			nm_notice.classList.add("inline");
			nm_notice.classList.add("notice-alt");
			nm_notice.style.visibility = "unset";
			nm_box.appendChild(nm_notice);
			noti_id++;
		}

		function nm_sanatize(nm_all_notice)
		{
			for(var i=0; i<nm_all_notice.length; i++)
			{
				if(nm_all_notice[i].classList.contains('hidden') || nm_all_notice[i].hasAttribute("aria-hidden"))
				{
					continue;
				}
				else
				{
					nm_add_to_container(nm_all_notice[i]);
				}
			}
		}

		
		nm_sanatize(document.querySelectorAll(".notice.notice-error"));
		nm_sanatize(document.querySelectorAll(".error"));
		nm_sanatize(document.querySelectorAll(".notice.notice-success"));
		nm_sanatize(document.querySelectorAll(".updated"));
		nm_sanatize(document.querySelectorAll(".notice.notice-warning"));
		nm_sanatize(document.querySelectorAll(".notice.notice-info"));

		var all_notices = document.querySelectorAll(".notice");

		for(var i=0; i<all_notices.length; i++)
		{
			if(all_notices[i].classList.contains("notice-success") 
				|| all_notices[i].classList.contains("notice-error") 
				|| all_notices[i].classList.contains("notice-warning")
				|| all_notices[i].classList.contains("notice-info")
				|| all_notices[i].classList.contains("hidden")
				|| all_notices[i].classList.contains("updated")
				|| all_notices[i].classList.contains("error")
				|| all_notices[i].hasAttribute('aria-hidden'))
			{
				continue;
			}
			else
			{
				nm_add_to_container(all_notices[i]);
			}
		}

	}
)
