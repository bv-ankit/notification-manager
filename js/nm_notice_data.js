window.addEventListener('load', function () 
	{
		let zero_notices_present = true;
		let notices_id = 1;
		let nm_container = document.querySelector("#nm_container");

		function nm_add_to_container(nm_notice)
		{
			if(zero_notices_present)
			{
				document.querySelector('#nm_container h3').remove();
				zero_notices_present = false;
			}

			nm_notice.classList.add("inline","notice-alt","nm-common");
			nm_notice.style.visibility = "unset";
			nm_container.appendChild(nm_notice);
			notices_id++;
		}

		function nm_sanitize_and_proceed(nm_notices)
		{
			for(let notice_number=0; notice_number<nm_notices.length; notice_number++)
			{
				if(nm_notices[notice_number].classList.contains("hidden") || nm_notices[notice_number].hasAttribute("aria-hidden"))
					{continue;}
				nm_add_to_container(nm_notices[notice_number]);
			}
		}
		
		if(nm_container != null)
		{
			nm_sanitize_and_proceed(document.querySelectorAll(".notice.notice-error"));
			nm_sanitize_and_proceed(document.querySelectorAll(".error"));
			nm_sanitize_and_proceed(document.querySelectorAll(".notice.notice-success"));
			nm_sanitize_and_proceed(document.querySelectorAll(".updated"));
			nm_sanitize_and_proceed(document.querySelectorAll(".notice.notice-warning"));
			nm_sanitize_and_proceed(document.querySelectorAll(".notice.notice-info"));

			let all_notices = document.querySelectorAll(".notice");

			for(let notice_number=0; notice_number<all_notices.length; notice_number++)
			{
				if(all_notices[notice_number].classList.contains("nm-common")
					|| all_notices[notice_number].classList.contains("hidden")
					|| all_notices[notice_number].hasAttribute("aria-hidden"))
					{continue;}
				
				nm_add_to_container(all_notices[notice_number]);
			}
		}
		else
		{
			document.getElementById("wpfooter").innerHTML += '<style>.notice {visibility:unset;}.updated {visibility:unset;}.error {visibility:unset;}</style>';
		}

	}
)
