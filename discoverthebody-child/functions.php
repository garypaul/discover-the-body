<?php
/* Logos */
	function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_stylesheet_directory_uri().'/images/logo.png) !important;
        	   height: 108px !important; background-size: 100% auto !important; }
    </style>
    <script type="text/javascript">window.onload = function(){document.getElementById("login").getElementsByTagName("a")[0].href = "'. site_url() . '";document.getElementById("login").getElementsByTagName("a")[0].title = "Go to site";}</script>';
	}

	add_action('login_head', 'my_custom_login_logo');


	// function change_wp_login_url()
	// {
	// 	echo bloginfo('url');
	// }add_filter('login_headerurl', 'change_wp_login_url');

	// function change_wp_login_title()
	// {
	// 	echo get_option('blogname');
	// }add_filter('login_headertitle', 'change_wp_login_title');

	function custom_admin_logo() {
		echo '<style type="text/css">#header-logo { background-image: url('.get_bloginfo('template_directory').'/images/logo-admin.png) !important; background-size:auto;}</style>';
	}
	add_action('admin_head', 'custom_admin_logo');

	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	add_action('woocommerce_before_main_content', 'dtb_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'dtb_wrapper_end', 10);

	function dtb_wrapper_start() {
	  echo '<div id="content">';
	}

	function dtb_wrapper_end() {
	  echo '</div>';
	}



?>
