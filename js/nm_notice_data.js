var MD5 = function(d){var r = M(V(Y(X(d),8*d.length)));return r.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}
window.addEventListener('load', function () 
	{
		let notices_id = 1;
		let nm_container_all = document.querySelector("#nm_container_all");
		let nm_container_unread = document.querySelector("#nm_container_unread");
		let nm_hash_of_read_notices_json = JSON.stringify(nm_hash_of_read_notices);
		let number_of_notifications = 0;
		let number_of_unread_notifications = 0;

		function nm_add_to_container(nm_notice)
		{
			let nm_notice_hash = MD5(nm_notice.innerHTML);
			if(nm_notice_hash == "d41d8cd98f00b204e9800998ecf8427e"){return;}
			nm_notice.classList.add("inline","notice-alt","nm-common");
			nm_notice.style.visibility = "unset";
			nm_container_all.appendChild(nm_notice);
			if(nm_hash_of_read_notices_json.includes(nm_notice_hash)){
				nm_notice.classList.add("nm-seen");
				return;
			}
			nm_container_unread.appendChild(nm_notice);
			notices_id++;
		}

		function nm_sanitize_and_proceed(nm_notices)
		{
			for(let notice_number=0; notice_number<nm_notices.length; notice_number++)
			{
				if(nm_notices[notice_number].classList.contains("hidden")
					|| nm_notices[notice_number].hasAttribute("aria-hidden")
					|| nm_notices[notice_number].classList.contains("hide-if-js"))
					{continue;}
				nm_add_to_container(nm_notices[notice_number]);
			}
		}

		function nm_container_mousevent_css(nm_visiblity, nm_display){
			nm_container.style.visibility = nm_visiblity;
			nm_container.style.display = nm_display;
		}

		function nm_all_notices_count(){
			return document.getElementsByClassName("nm-common").length;
		}

		function nm_unread_notices_count(){
			return nm_all_notices_count() - document.getElementsByClassName("nm-seen").length;
		}

		function refresh_no_notice_state(){
			if(document.getElementById("nm_container_all").style.display == "none" || document.getElementById("nm_container_all").style.display == ""){
				document.getElementById("no_new_notifications").style.display = nm_unread_notices_count()==0 ? "block" : "none";
			}
			else{
				document.getElementById("no_new_notifications").style.display = nm_all_notices_count()==0 ? "block" : "none";
			}
		}

		function refresh_notification_numbers(){
			document.getElementById("notification-count").innerHTML = 'Notifications <span id="nm_display_notification_number">' + nm_all_notices_count() + '</span>';
			document.getElementById("nm_count_unread").innerHTML = nm_unread_notices_count();
			document.getElementById("nm_count_all").innerHTML = nm_all_notices_count();
		}

		function nm_alert_for_notice(){
			if(nm_unread_notices_count() != 0){
				document.getElementById("nm_notice_alert_box").classList.add("nm_alert_animation");
			}
		}

		function mark_all_as_read(event){
		 	if(event.target.id == "mark_as_read_button"){
		 		let nm_container_unread_notifications = document.querySelector("#nm_container_unread").querySelectorAll(".nm-common");
		 		if(nm_container_unread_notifications.length > 0){
		 			const new_hashes = [];
		 			for( let unread_notification=0; unread_notification < nm_container_unread_notifications.length; unread_notification++){
		 				let nm_unread_notification = nm_container_unread_notifications[unread_notification];
		 				//let nm_unread_notification_hash = MD5(nm_unread_notification.innerHTML);
		 				new_hashes.push(MD5(nm_unread_notification.innerHTML));
		 				nm_unread_notification.classList.add("nm-seen");
		 				nm_container_all.appendChild(nm_unread_notification);
		 			}
		 			jQuery(document).ready(function($){             
                                        	$.ajax({
                                         	type: "POST",
                                         	url: ajaxurl,
                                         	data: {action: "update_notification_option", 'nm_notices_hash_data': new_hashes},
                                         	});
                                 	});
		 		}
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
					|| all_notices[notice_number].hasAttribute("aria-hidden")
					|| all_notices[notice_number].classList.contains("hide-if-js"))
					{continue;}
				
				nm_add_to_container(all_notices[notice_number]);
			}
		}
		else
		{
			document.getElementById("wpfooter").innerHTML += '<style>.notice {visibility:unset;}.updated {visibility:unset;}.error {visibility:unset;}</style>';
		}

		let admin_notification = document.getElementById("wp-admin-bar-notification-manager");
		admin_notification.addEventListener("mouseover", function(event) {nm_container_mousevent_css("visible","block");})
		admin_notification.addEventListener("mouseout", function(event) {nm_container_mousevent_css("none","none");})


		nm_container.addEventListener("mouseover", function(event) {nm_container_mousevent_css("visible","block");})
		nm_container.addEventListener("mouseout", function(event) {nm_container_mousevent_css("none","none");})
		nm_container.addEventListener("click", function(event) {mark_all_as_read(event);refresh_no_notice_state();setTimeout(refresh_notification_numbers, 300);})
		refresh_no_notice_state();
		refresh_notification_numbers();
		setTimeout(nm_alert_for_notice, 15000);
	}
)
