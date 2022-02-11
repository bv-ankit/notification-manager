<?php
if(function_exists('nm_data'))
{
	echo '<div class="notice notice-error">';
	echo '<h1> Data was not added (conflict in function naming) </h1>';
	echo '</div>';
}
else
{
	function nm_data()
	{
		//hiding all the default notices
		echo '<style> .notice{display:none;} .notice.notice-alt{display:"" !important;} .updated{display:none;} .error{display:none} </style>';
		//------------ handle the case of direct showing notifications getting hidden
		//------------ handle the case of showing the data on a smaller screen

		//defining all the needed variables
		global $wp_filter;
		$notices = [];
		$regexp = "#<div([^<>]*)>(.*?)</div>#s";
		$class_regexp = '`class=\"([^\"]+)\"`iS';
		$collection = $wp_filter['admin_notices'];
		$notices[] = []; //errors array   : 0
		$notices[] = []; //success array  : 1
		$notices[] = []; //warning array  : 2
		$notices[] = []; //info array     : 3
		$notices[] = []; //misc array     : 4
		if(isset($collection))
		{
			foreach($collection as $priority => $admin_notice_group)
			{
				foreach ((array) $admin_notice_group as $notice_key => $action)
				{
					if(!is_null($action['function']))
					{
						// run callback function and get output
						ob_start();
						call_user_func( $action['function'] );
						$output = trim( ob_get_clean() );

						//running regex and saving data
						if ( false !== preg_match_all( $regexp, $output, $matches ) and count($matches[2]) != 0)
						{
							for($i=0; $i<count($matches[2]); $i++)
							{	
								if ( false !== preg_match_all( $class_regexp, $matches[1][$i], $class_values ) and count($class_values) != 0 )
								{
									$type = 4; // this is set as the default type (misc) for the notice
									$nclass = explode(" ", $class_values[1][0]);  // array of all previous classes

									//-------------- deal with all the notices which will act directly without adding themselves to admin_notices

									if(in_array("notice",$nclass))
                                                                        {
										// updating the class list
										unset($nclass[array_search("notice",$nclass,false)]); // removing the class which will help us to hide all the remaining classes
										$aclass = join(" ",$nclass);  // the array of updated classes
										$dismis_type = in_array("is-dismissible",$nclass) ? true : false;

										//updating the type of notice if given
										if(in_array("notice-error",$nclass)) $type = 0;
										if(in_array("notice-success",$nclass)) $type = 1;
										if(in_array("notice-warning",$nclass)) $type = 2;
										if(in_array("notice-info",$nclass)) $type = 3;
										
										//$message = trim( strip_tags( $matches[2][$i], '<a>' ) );
										$notices[$type][] = ['data'=>$matches[2][$i], 'dismis_type'=>$dismis_type, 'classes'=>$aclass];
									}
									/*
									 * --------------------------- changes needed to fetch updated and error notices
									elseif(in_array("error",$nclass))
									{
										//updating the class list
										unset($nclass[array_search("error",$nclass,false)]);
										$aclass = join(" ",$nclass);
										$dismis_type = in_array("is-dismissible",$nclass) ? true : false;
										
										$type = 0; // error type is set as 0

										$notices[$type][] = ['data'=>$matches[2][$i], 'dismis_type'=>$dismis_type, 'classes'=>$aclass];
									}
									elseif(in_array("updated",$nclass))
									{
										//updating the class list
										unset($nclass[array_search("updated",$nclass,false)]);
										$aclass = join(" ",$nclass);
										$dismis_type = in_array("is-dismissible",$nclass) ? true : false;

										$type = 1; // updated type is set as success as 1

										$notices[$type][] = ['data'=>$matches[2][$i], 'dismis_type'=>$dismis_type, 'classes'=>$aclass];
									}
									 */
								}
							}
						}
					}
				}
			}

		}
		update_option('noti_data',$notices);
	}

	add_action('in_admin_header', 'nm_data', -1);
}
