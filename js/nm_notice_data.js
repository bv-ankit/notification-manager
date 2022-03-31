window.addEventListener('load', function () 
	{
		let nm_container = document.querySelector("#nm_container");
		let nm_container_all = document.querySelector("#nm_container_all");
		let nm_container_unread = document.querySelector("#nm_container_unread");
		let nm_hash_of_read_notices_json = JSON.stringify(nm_hash_of_read_notices);
		
		function nm_add_to_container( nm_notice ) {
			let nm_notice_text = nm_notice.textContent.replaceAll(' ','');	
			let nm_notice_hash_with_dismis = MD5(nm_notice_text + 'Dismissthisnotice.');
			let nm_notice_hash = MD5( nm_notice_text );
			if ( nm_notice_hash == "d41d8cd98f00b204e9800998ecf8427e" ){ return; }
			
			nm_notice.classList.add("inline", "notice-alt", "nm-common");
			nm_notice.style.visibility = "unset";

			
			if ( nm_hash_of_read_notices_json.includes( nm_notice_hash ) || nm_hash_of_read_notices_json.includes( nm_notice_hash_with_dismis ) ) {
				nm_container_all.appendChild(nm_notice);
				nm_notice.classList.add("nm-seen");
				return;
			}
			nm_container_unread.appendChild(nm_notice);
		}

		function nm_sanitize_and_proceed( nm_notices ) {
			for ( let nm_notice_idx = 0; nm_notice_idx < nm_notices.length; nm_notice_idx++) {
				if ( nm_notices[nm_notice_idx].classList.contains("hidden")
					|| nm_notices[nm_notice_idx].hasAttribute("aria-hidden")
					|| nm_notices[nm_notice_idx].classList.contains("hide-if-js")
					|| nm_notices[nm_notice_idx].classList.contains("inline") ) { 
						continue;
				}
				nm_add_to_container( nm_notices[nm_notice_idx] );
			}
		}

		if( nm_container != null ) {

			document.querySelectorAll(".inline").forEach( (nm_inline_notice) => {
				nm_inline_notice.style.visibility = "visible";
			})

			let nm_list_of_notice_types = [".notice.notice-error", ".error", ".notice.notice-success", ".updated", ".notice.notice-warning", ".notice.notice-info"]
			nm_list_of_notice_types.forEach( (nm_notice_type) => {
				nm_sanitize_and_proceed(document.querySelectorAll(nm_notice_type));
			})

			let all_notices = document.querySelectorAll(".notice");
			for ( let notice_number = 0; notice_number < all_notices.length; notice_number++ ){
				if ( all_notices[notice_number].classList.contains("nm-common")
					|| all_notices[notice_number].classList.contains("hidden")
					|| all_notices[notice_number].classList.contains("hide-if-js")
					|| all_notices[notice_number].classList.contains("inline")
					|| all_notices[notice_number].hasAttribute("aria-hidden") ){
						continue;
				}
				nm_add_to_container( all_notices[notice_number] );
			}
		}
		else
		{
			document.getElementById("wpfooter").innerHTML += '<style>.notice{visibility:unset;} .updated{visibility:unset;} .error{visibility:unset;}</style>';
		}

		function mark_all_as_read( event ) {
	 		let nm_unread_notices = document.querySelectorAll("#nm_container_unread .nm-common");
	 		if ( nm_unread_notices.length > 0 ) {
	 			let nm_hashes = [];
	 			for( let nm_notice_idx = 0; nm_notice_idx < nm_unread_notices.length; nm_notice_idx++) {
					let nm_unread_notice_without_spaces = nm_unread_notices[nm_notice_idx].textContent.replaceAll(' ','');
	 				nm_hashes.push( MD5( nm_unread_notice_without_spaces  ) );
	 				nm_unread_notices[nm_notice_idx].classList.add("nm-seen");
	 				nm_container_all.appendChild(nm_unread_notices[nm_notice_idx]);
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


		function nm_all_notices_count() {
			return document.getElementsByClassName("nm-common").length;
		}

		function nm_unread_notices_count() {
			return nm_all_notices_count() - document.getElementsByClassName("nm-seen").length;
		}

		let nm_no_new_notice = document.getElementById("nm_no_new_notice");

		function refresh_no_notice_state() {
			if ( nm_container_all.style.display == "none" || nm_container_all.style.display == "" ) {
				nm_no_new_notice.style.display = nm_unread_notices_count() == 0 ? "block" : "none";
			}
			else {
				nm_no_new_notice.style.display = nm_all_notices_count() == 0 ? "block" : "none";
			}
		}

		let nm_count_all = document.getElementById("nm_count_all");
		let nm_count_unread = document.getElementById("nm_count_unread");
		let nm_notification_count = document.getElementById("nm_notification_count");

		function refresh_notification_numbers() {
			let nm_count_text =  nm_unread_notices_count() > 0 ? 'Notifications <span id="nm_display_notification_number">' + nm_unread_notices_count() + '</span>' : 'Notifications';
			nm_notification_count.innerHTML = nm_count_text;
			nm_count_unread.innerHTML = nm_unread_notices_count();
			nm_count_all.innerHTML = nm_all_notices_count();
		}

		function nm_alert_for_notice() {
			if( nm_unread_notices_count() != 0 ) {
				document.getElementById("nm_notice_alert_box").classList.add("nm_alert_animation");
			}
		}
		
		let nm_mark_as_read = document.getElementById("nm_mark_as_read");
		nm_mark_as_read.addEventListener("click", function(event) { mark_all_as_read(event); })

		refresh_no_notice_state();
		refresh_notification_numbers();
		setTimeout(nm_alert_for_notice, 15000);

		function nm_container_mousevent_css( nm_visiblity, nm_display ) {
			nm_container.style.visibility = nm_visiblity;
			nm_container.style.display = nm_display;
		}

		let admin_notification = document.getElementById("wp-admin-bar-notification-manager");
		admin_notification.addEventListener("mouseover", function(event) { nm_container_mousevent_css("visible","block"); })
		admin_notification.addEventListener("mouseout", function(event) { nm_container_mousevent_css("none","none"); })

		nm_container.addEventListener("mouseover", function(event) { nm_container_mousevent_css("visible","block"); })
		nm_container.addEventListener("mouseout", function(event) { nm_container_mousevent_css("none","none"); })
		nm_container.addEventListener("click",function() { refresh_no_notice_state(); setTimeout(refresh_notification_numbers, 300);} )
	}
)
