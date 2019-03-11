<?php

/**
* Manage all the plugin admin side
*/
class AppOrPrepp_Admin
{

	public function __construct() {
		add_action( 'admin_init', array( $this, 'register_fields' ) );
	}

	public function register_fields() {

		add_settings_section(
			'apporprep_section', __( 'Append or Prepend Content Settings', 'apporprep' ), array( $this, 'header_html' ), 'writing'
		);

		$post_types = get_post_types( array( 'public' => true ), 'objects' );

		foreach ( $post_types as $post_type => $object ) {

			if ( ( 'page' === $post_type ) || ( 'attachment' === $post_type ) ) {
				continue;
			}

			add_settings_field(
				'prepend_' . $post_type, 
				'<label for="prepend_' . $post_type . '">Prepend content to ' . $object->labels->name . '</label>', 
				array( $this, 'prepend_html' ), 
				'writing', 
				'apporprep_section', 
				array( 'post_type' => $post_type )
			);

			register_setting(
				'writing',
				'prepend_' . $post_type
			);

			add_settings_field(
				'append_' . $post_type,
				'<label for="append_' . $post_type . '">Append content to ' . $object->labels->name . '</label>',
				array( $this, 'append_html' ),
				'writing',
				'apporprep_section',
				array( 'post_type' => $post_type  )
			);

			register_setting(
				'writing',
				'append_' . $post_type
			);

		}


	}

	public function header_html() {

		$post_types = get_post_types( array( 'public' => true ), 'objects' );

		?>
		<p><?php _e( 'Allows you to append or prepend content to any Post Type on your site. Shortcodes allowed.', 'apporprep' ); ?></p>
		<pre><?php // print_r($post_types); ?></pre>
		<?php
	}

	public function prepend_html($args) {
		$post_type = $args['post_type'];
		$value = get_option( 'prepend_' . $post_type, '' );
		wp_editor( 
			$value, 
			'prepend_' . $post_type, 
			array( 
				'quicktags' => false,
				'media_buttons' => false,
				'textarea_rows' => 5,
				'teeny' => true
			)
		);
	}

	public function append_html($args) {
		$post_type = $args['post_type'];
		$value = get_option( 'append_' . $post_type, '' );
		wp_editor(
			$value,
			'append_' . $post_type,
			array(
				'quicktags' => false,
				'media_buttons' => false,
				'textarea_rows' => 5,
				'teeny' => true 			)
		);
	}

}