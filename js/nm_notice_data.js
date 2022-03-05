window.addEventListener('load', function () 
	{
		let notices_id = 1;
		let nm_container_all = document.querySelector("#nm_container_all");
		let nm_container_unread = document.querySelector("#nm_container_unread");
		let nm_hash_of_read_notices_json = JSON.stringify(nm_hash_of_read_notices);
		let number_of_notifications = 0;
 		let number_of_unread_notifications = 0;

		function nm_add_to_container( nm_notice )
		{
			let nm_notice_hash = MD5( nm_notice.innerHTML );
			if ( nm_notice_hash == "d41d8cd98f00b204e9800998ecf8427e" ){ return; }
			nm_notice.classList.add("inline", "notice-alt", "nm-common");
			nm_notice.style.visibility = "unset";
			nm_container_all.appendChild(nm_notice);
			if ( nm_hash_of_read_notices_json.includes( nm_notice_hash ) ) {
				nm_notice.classList.add("nm-seen");
				return;
			}
			nm_container_unread.appendChild(nm_notice);
			notices_id++;
		}

		function nm_sanitize_and_proceed( nm_notices )
		{
			for ( let notice_number = 0; notice_number < nm_notices.length; notice_number++)
			{
				if ( nm_notices[notice_number].classList.contains("hidden")
					|| nm_notices[notice_number].hasAttribute("aria-hidden")
					|| nm_notices[notice_number].classList.contains("hide-if-js")
					|| nm_notices[notice_number].classList.contains("inline") )
					{ continue; }
				nm_add_to_container( nm_notices[notice_number] );
			}
		}

		if( nm_container != null )
		{
			let nm_inline_notices = document.querySelectorAll(".inline");
			for ( let nm_inline_notice = 0; nm_inline_notice < nm_inline_notices.length; nm_inline_notice++)
			{
				nm_inline_notices[nm_inline_notice].style.visibility = "visible";
			}
			nm_sanitize_and_proceed(document.querySelectorAll(".notice.notice-error"));
			nm_sanitize_and_proceed(document.querySelectorAll(".error"));
			nm_sanitize_and_proceed(document.querySelectorAll(".notice.notice-success"));
			nm_sanitize_and_proceed(document.querySelectorAll(".updated"));
			nm_sanitize_and_proceed(document.querySelectorAll(".notice.notice-warning"));
			nm_sanitize_and_proceed(document.querySelectorAll(".notice.notice-info"));

			let all_notices = document.querySelectorAll(".notice");

			for ( let notice_number=0; notice_number < all_notices.length; notice_number++ )
			{
				if ( all_notices[notice_number].classList.contains("nm-common")
					|| all_notices[notice_number].classList.contains("hidden")
					|| all_notices[notice_number].hasAttribute("aria-hidden")
					|| all_notices[notice_number].classList.contains("hide-if-js")
					|| all_notices[notice_number].classList.contains("inline") )
					{ continue; }
				
				nm_add_to_container( all_notices[notice_number] );
			}
		}
		else
		{
			document.getElementById("wpfooter").innerHTML += '<style>.notice {visibility:unset;}.updated {visibility:unset;}.error {visibility:unset;}</style>';
		}

		// ---------------------

		function mark_all_as_read( event ) {
		 	if ( event.target.id == "mark_as_read_button" )
		 	{
		 		let nm_unread_notices = document.querySelectorAll("#nm_container_unread .nm-common");
		 		if ( nm_unread_notices.length > 0 )
		 		{
		 			const nm_hashes = [];
		 			for( let nm_notice_idx = 0; nm_notice_idx < nm_unread_notices.length; nm_notice_idx++)
		 			{
		 				let nm_notice = nm_unread_notices[nm_notice_idx];
		 				nm_hashes.push( MD5( nm_notice.innerHTML ) );
		 				nm_notice.classList.add("nm-seen");
		 				nm_container_all.appendChild(nm_notice);
		 			}

		 			jQuery(document).ready(function($){             
                                        	$.ajax({
                                         	type: "POST",
                                         	url: ajaxurl,
                                         	data: { action: "update_notification_option", 'nm_notices_hash_data': nm_hashes },
                                         	});
                                 	});
		 		}
		 	}
		}


		function nm_all_notices_count() {
			return document.getElementsByClassName("nm-common").length;
		}

		function nm_unread_notices_count() {
			return nm_all_notices_count() - document.getElementsByClassName("nm-seen").length;
		}

		function refresh_no_notice_state() {
			if ( document.getElementById("nm_container_all").style.display == "none" || document.getElementById("nm_container_all").style.display == "" ) {
				document.getElementById("no_new_notifications").style.display = nm_unread_notices_count()==0 ? "block" : "none";
			}
			else {
				document.getElementById("no_new_notifications").style.display = nm_all_notices_count()==0 ? "block" : "none";
			}
		}

		function refresh_notification_numbers() {
			let nm_count_text =  nm_unread_notices_count() > 0 ? 'Notifications <span id="nm_display_notification_number">' + nm_unread_notices_count() + '</span>' : 'Notifications';
			document.getElementById("notification-count").innerHTML = nm_count_text;
			document.getElementById("nm_count_unread").innerHTML = nm_unread_notices_count();
			document.getElementById("nm_count_all").innerHTML = nm_all_notices_count();
		}

		function nm_alert_for_notice() {
			if( nm_unread_notices_count() != 0 ) {
				document.getElementById("nm_notice_alert_box").classList.add("nm_alert_animation");
			}
		}

		nm_container.addEventListener(
			"click",
			function(event) {
				mark_all_as_read(event);
				refresh_no_notice_state();
				setTimeout(refresh_notification_numbers, 300);
			}
		)

		refresh_no_notice_state();
		refresh_notification_numbers();
		setTimeout(nm_alert_for_notice, 15000);


		// ----------------------

		function nm_container_mousevent_css( nm_visiblity, nm_display ) {
			nm_container.style.visibility = nm_visiblity;
			nm_container.style.display = nm_display;
		}

		let admin_notification = document.getElementById("wp-admin-bar-notification-manager");
		admin_notification.addEventListener("mouseover", function(event) { nm_container_mousevent_css("visible","block"); })
		admin_notification.addEventListener("mouseout", function(event) { nm_container_mousevent_css("none","none"); })
		nm_container.addEventListener("mouseover", function(event) { nm_container_mousevent_css("visible","block"); })
		nm_container.addEventListener("mouseout", function(event) { nm_container_mousevent_css("none","none"); })
	}
)
