<?php

namespace Mdm\Gymfinity;

use \Mdm\Gymfinity\Utilities as Utilities;

class Admin extends \Mdm\Gymfinity {

	public function register_assets() {
		// Register Styles
		wp_register_style( sprintf( '%s_admin', parent::$plugin_name ), Utilities::url( 'styles/dist/admin.min.css' ), array( 'wp-color-picker' ), null, 'all' );
		// Register scripts
		wp_register_script( sprintf( '%s_admin', parent::$plugin_name ), Utilities::url( 'scripts/dist/admin.min.js' ), array( 'jquery', 'wp-color-picker' ), parent::$plugin_version, true );
	}

	public function enqueue_assets() {
		// Enqueue Style
		wp_enqueue_style( sprintf( '%s_admin', parent::$plugin_name ) );
		// Enqueue Scripts
		wp_enqueue_script( sprintf( '%s_admin', parent::$plugin_name ) );
	}

	public function after_title_message() {
		// Content block message
		if( get_post_type() === 'content_block' ) {
			printf( '<p><strong>Shortcode:</strong> <code>[content_block id=%d title="%s"]</code></p>', get_the_id(), get_the_title() );
		}
	}
}