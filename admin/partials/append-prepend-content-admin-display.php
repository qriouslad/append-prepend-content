<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://bowo.io
 * @since      1.0.0
 *
 * @package    Append_Prepend_Content
 * @subpackage Append_Prepend_Content/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap append-prepend-settings">

	<form action="options.php" method="post">
		<?php

			settings_fields( 'apporprep' );

			do_settings_sections( 'apporprep' );

			submit_button( 'Save Settings' );

		?>
	</form>

</div>