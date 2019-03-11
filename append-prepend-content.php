<?php

/**
* Plugin Name: Append or Prepend Content
* Plugin URI: https://github.com/qriouslad/append-or-prepend-content
* Description: Append or Prepend Content allows you to append or prepend content to any Post Type on your site. You can even use shortcodes or HTML.
* Author: Bowo
* Version: 0.3
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

		add_filter( 'the_content', array( $this, 'apporprepp_the_content' ) );

	}

	public function apporprepp_the_content ( $content ) {
		$post = get_post();
		$post_type = get_post_type( $post );
		$prepend = get_option( 'prepend_' . $post_type, '' );
		$append = get_option( 'append_' . $post_type, '' );

		if ( $prepend ) {
			$content = wpautop( $prepend ) . $content;
		}

		if ( $append ) {
			$content = $content . wpautop( $append );
		}

		return $content;

	}

}

add_action( 'plugins_loaded', 'app_or_prepp' );
function app_or_prepp() {
	return AppOrPrepp::get_instance();
}

?>