<?php
/*
Plugin Name: typenotice
Plugin URI: http://example.com
Description: example to show all kinds of notices
Version: 1.0
Author: someone
Author URI: http://piyush-soni.github.io
 */


function InfoPlugins_add_settings_errors() 
{
?>
<div class="notice notice-error is-dismissible">
	<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus malesuada justo eu elit dictum, sit amet condimentum purus bibendum. Vivamus malesuada metus tortor, ac volutpat risus sodales id. Nam ut sapien eu metus tempus bibendum ut in nibh. Vivamus ultricies purus ac est consectetur, at tempus felis fermentum. Sed ut posuere eros. Quisque eleifend nisl nec nisl condimentum pellentesque. Nam finibus faucibus dictum. Donec suscipit semper odio et viverra. Suspendisse sit amet ligula quis ipsum ultrices blandit. Donec non velit sed leo tincidunt lacinia. Cras porta augue in vehicula gravida. Duis dui lacus, blandit quis elit in, facilisis cursus orci. In faucibus leo vitae sapien bibendum convallis. Morbi nec risus eget elit blandit laoreet. Curabitur quis felis scelerisque, dictum neque nec, euismod dui.
	</p>
</div>
<div class="notice notice-success is-dismissible">
	<p> 
		<strong> Success  </strong> 
	</p>
</div>
<div class="notice notice-error is-dismissible">
        <p>
                <strong> Error  </strong>
        </p>
</div>
<div class="notice notice-warning is-dismissible">
        <p>
                <strong> Warning  </strong>
        </p>
</div>
<div class="notice notice-info is-dismissible">
        <p>
                <strong> Info  </strong>
        </p>
</div>

<div class="notice notice-error ">
	<p>
		<strong> Error  </strong>
	</p>
</div>
<div class="notice notice-info ">
        <p>
                <strong> Info  </strong>
        </p>
</div>
<div class="notice notice-success ">
        <p>
                <strong> Success  </strong>
        </p>
</div>
<div class="notice notice-warning ">
        <p>
                <strong> Warning  </strong>
        </p>
</div>
<?php
}
add_action('admin_notices', 'InfoPlugins_add_settings_errors');
