<?php

/**
* Plugin Name: Append or Prepend Content
* Plugin URI: https://github.com/qriouslad/append-or-prepend-content
* Description: Append or Prepend Content allows you to append or prepend content to any Post Type on your site. You can even use shortcodes or HTML.
* Author: Bowo
* Version: 0.2
* Author URI: http://bowo.io/
* GitHub Plugin URI: https://github.com/qriouslad/append-or-prepend-content
*/

class AppOrPrepp 
{
	private static $instance;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;

	}

	public function __construct() {
		if ( is_admin() ) {
			include_once( plugin_dir_path( __FILE__ ) . '/admin.php' );
			new AppOrPrepp_Admin();
		}
	}

}

add_action( 'plugins_loaded', 'app_or_prepp' );
function app_or_prepp() {
	return AppOrPrepp::get_instance();
}

?>