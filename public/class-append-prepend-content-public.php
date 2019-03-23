<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://bowo.io
 * @since      1.0.0
 *
 * @package    Append_Prepend_Content
 * @subpackage Append_Prepend_Content/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Append_Prepend_Content
 * @subpackage Append_Prepend_Content/public
 * @author     Bowo <hello@bowo.io>
 */
class Append_Prepend_Content_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Append_Prepend_Content_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Append_Prepend_Content_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/append-prepend-content-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Append_Prepend_Content_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Append_Prepend_Content_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/append-prepend-content-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Append or prepend content defined in settinsg to each post type
	 */
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
