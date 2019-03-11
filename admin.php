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
			'apporprep_section', __( 'Append or Prepend Content Settins', 'apporprep' ), array( $this, 'header_html' ), 'writing'
		);
	}

	public function header_html() {
		?>
		<p><?php _e( 'Allows you to append or prepend content to any Post Type on your site. Shortcodes allowed.', 'apporprep' ); ?></p>
		<?php
	}

}