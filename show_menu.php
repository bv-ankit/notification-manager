<?php
/**
 * Plugin Name: Admin Menu item: trying
 * Plugin Description: Plugin showing a new item in Admin bar
 **/
$notices = array();
function trying_filter_11() {
	global $wp_filter;
	$collection = $wp_filter['admin_notices'];
	// check if there are notices
	if ( isset( $collection ) ) {
		//echo '<pre>';
		//var_dump($collection);
		//echo '</pre>';
		// loop through priorities
		foreach ( $collection as $priority => $admin_notice_group ) {

			// loop through actions of this priority
			foreach ( (array) $admin_notice_group as $notice_key => $action ) {
				// check if a callback function isset for $action
				if ( ! is_null( $action['function'] ) ) {
					// run callback function and get output
					ob_start();
					call_user_func( $action['function'] );
					$output = trim( ob_get_clean() );
					// the regex
					$regexp = "`<div([^<>]*)>(.*)</div>`is";
					// do preg match
					if ( false !== preg_match_all( $regexp, $output, $matches ) ) {
						/**
						 * 0 = FULL STRING
						 *  Example -> <div -----> 
						 *  			<p>---</p>
						 *  			<p>---</p>
						 *  		</div>
						 *
						 *
						 * 1 = ATTRIBUTES 
						 *  Example -> class='notice notice-error'
						 *
						 *
						 *
						 * 2 = CONTENT
						 *  Example -> <p>---</p>
						 *  	       <p>---</p>
						 */

						if ( count( $matches[0] ) > 0 ) {
							// fetch class attribute values from all attributes
							$class_regexp = '`class=\"([^\"]+)\"`iS';
							//regex on class values
							if ( false !== preg_match_all( $class_regexp, $matches[1][0], $class_values ) ) {
								// check if we got results
								if ( count( $class_values[0] ) > 0 ) {

									// notification types
									$types = explode( ' ', $class_values[1][0] ); //types store class types like :- [notice, notice-error, is-dismissible]
									//echo htmlspecialchars($matches[2][0]); //This can be used to print actual string (means tagged)


									// notification message
									$message = trim( strip_tags( $matches[2][0], '<a>' ) );   //Removing the outer tags like  <p>, </p>
									echo htmlspecialchars($message);


									// add types and messages to notices array!!!
									//

									// remove admin notice
									//unset( $collection[ $priority ][ $notice_key ] );

								}

							}

						}
					}
				}
			}
		}

	}


}
add_action('in_admin_header', 'trying_filter_11', -1);
