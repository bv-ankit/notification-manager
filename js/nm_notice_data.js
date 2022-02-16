window.addEventListener('load', function () 
	{
		var zero_notices_present = true;
		var notices_id = 1;
		var nm_container = document.querySelector("#nm_container");

		function nm_add_to_container(nm_notice)
		{
			if(zero_notices_present)
			{
				document.querySelector('#nm_container h3').remove();
				zero_notices_present = false;
			}
			
			nm_container.innerHTML += '<div id="all_nm_'+notices_id+'"></div><br>';

			var nm_notice_div_id = '#all_nm_'+notices_id;
			var nm_div_box = document.querySelector(nm_notice_div_id);

			nm_notice.classList.add("inline","notice-alt");
			nm_notice.style.visibility = "unset";
			
			nm_div_box.appendChild(nm_notice);
			notices_id++;
		}

		function nm_sanitize(nm_notices)
		{
			for(var i=0; i<nm_notices.length; i++)
			{
				if(nm_notices[i].classList.contains('hidden') || nm_notices[i].hasAttribute("aria-hidden"))
					{continue;}
				nm_add_to_container(nm_notices[i]);
			}
		}
		
		if(nm_container != null)
		{
			nm_sanitize(document.querySelectorAll(".notice.notice-error"));
			nm_sanitize(document.querySelectorAll(".error"));
			nm_sanitize(document.querySelectorAll(".notice.notice-success"));
			nm_sanitize(document.querySelectorAll(".updated"));
			nm_sanitize(document.querySelectorAll(".notice.notice-warning"));
			nm_sanitize(document.querySelectorAll(".notice.notice-info"));

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
					{continue;}
				
				nm_add_to_container(all_notices[i]);
			}
		}
		else
		{
			document.getElementById("wpfooter").innerHTML += '<style>.notice {visibility:unset;}.updated {visibility:unset;}.error {visibility:unset;}</style>';
		}

	}
)
