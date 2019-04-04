<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bowo.io
 * @since      1.0.0
 *
 * @package    Append_Prepend_Content
 * @subpackage Append_Prepend_Content/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Append_Prepend_Content
 * @subpackage Append_Prepend_Content/admin
 * @author     Bowo <hello@bowo.io>
 */
class Append_Prepend_Content_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/append-prepend-content-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/append-prepend-content-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add settings page as sub-menu of Settings
	 */

	public function append_prepend_menu_page() {

		add_options_page(
			'Settings for Append or Prepend Content',
			'Append Prepend',
			'manage_options',
			'append_prepend_content',
			array( $this, 'settings_page_content' )
		);

	}

	/**
	 * Register settings page at the bottom of the Writing page
	 */
	public function append_prepend_settings() {

		add_settings_section(
			'apporprep_section', 
			'Append or Prepend Content', 
			array( $this, 'header_html' ), 
			'apporprep'
		);

		$post_types = get_post_types( array( 'public' => true ), 'objects' );

		foreach ( $post_types as $post_type => $object ) {

			if ( ( 'page' === $post_type ) || ( 'attachment' === $post_type ) || ( 'fl-builder-template' === $post_type ) ) {
				continue;
			}

			register_setting(
				'apporprep',
				'prepend_' . $post_type
			);

			register_setting(
				'apporprep',
				'append_' . $post_type
			);

			add_settings_field(
				'prepend_' . $post_type, 
				'<label for="prepend_' . $post_type . '">Prepend content to ' . $object->labels->name . '</label>', 
				array( $this, 'prepend_html' ), 
				'apporprep', 
				'apporprep_section', 
				array( 'post_type' => $post_type )
			);

			add_settings_field(
				'append_' . $post_type,
				'<label for="append_' . $post_type . '">Append content to ' . $object->labels->name . '</label>',
				array( $this, 'append_html' ),
				'apporprep',
				'apporprep_section',
				array( 'post_type' => $post_type  )
			);

		}

	}

	/**
	 * Add description for plugin settings inside the Writing page
	 */
	public function header_html() {

		echo '<p>The settings below allow you to append or prepend content to the listed post types on your site. Shortcodes are allowed inside these sections.</p>';

	}

	/**
	 * Render WP editor to prepend content
	 */
	public function prepend_html($args) {
		$post_type = $args['post_type'];
		$value = get_option( 'prepend_' . $post_type, '' );
		wp_editor( 
			$value, 
			'prepend_' . $post_type, 
			array( 
				'quicktags' => true,
				'media_buttons' => true,
				'textarea_rows' => 10,
				'teeny' => false,
			)
		);
	}

	/**
	 * Render WP editor to append content
	 */
	public function append_html($args) {

		$post_type = $args['post_type'];

		$value = get_option( 'append_' . $post_type, '' );

		wp_editor(
			$value,
			'append_' . $post_type,
			array(
				'quicktags' => true,
				'media_buttons' => true,
				'textarea_rows' => 10,
				'teeny' => false,
			)
		);

	}

	/**
	 * Content of the plugin settings page
	 */
	public function settings_page_content() {

		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		include 'partials/append-prepend-content-admin-display.php';

	}

}