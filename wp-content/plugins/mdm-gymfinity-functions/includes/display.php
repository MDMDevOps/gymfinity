<?php

namespace Mdm\Gymfinity;

use \Mdm\Gymfinity\Utilities as Utilities;

class Display extends \Mdm\Gymfinity {

	public function register_assets() {
		wp_register_style( sprintf( '%s_display',  parent::$plugin_name ), Utilities::url( 'styles/dist/display.min.css' ), array(),  parent::$plugin_version, 'all' );
		wp_register_script( sprintf( '%s_display', parent::$plugin_name ), Utilities::url( 'scripts/dist/display.min.js' ), array( 'jquery' ), parent::$plugin_version, true );
	}

	/**
	 * Enqueue admin side assets
	 * @since 1.0.0
	 * @see https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @see https://developer.wordpress.org/reference/functions/wp_localize_script/
	 */
	public function enqueue_assets() {
		wp_enqueue_style( sprintf( '%s_display',  parent::$plugin_name ) );
		wp_enqueue_script( sprintf( '%s_display',  parent::$plugin_name ) );
		wp_localize_script( sprintf( '%s_display', parent::$plugin_name ), parent::$plugin_name, array( 'wpajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

	public function content_block_shortcode( $atts = array() ) {
		ob_start();
		$content_blocks = \Mdm\Gymfinity\Posts\ContentBlocks::get_instance();
		$content_blocks->output( $atts );
		return ob_get_clean();
	}

	public function content_block_action( $atts = array() ) {
		$content_blocks = \Mdm\Gymfinity\Posts\ContentBlocks::get_instance();
		$content_blocks->output( $atts );
	}

}