<?php

namespace Mdm\Gymfinity\Posts;

use \Mdm\Gymfinity\Utilities as Utilities;

class ContentBlocks extends \Mdm\Gymfinity {

	protected static $post_type = 'content_block';

	protected static $default_atts;

	public function get_type() {
		return self::$post_type;
	}

	public function set_fields() {
		self::$default_atts = array( 'id' => null, 'class' => null, 'template' => null, );
	}

	public static function register() {
		$labels = array(
		    'name'                  => _x( 'Content Blocks', 'Post Type General Name', parent::$plugin_name ),
		    'singular_name'         => _x( 'Content Block', 'Post Type Singular Name', parent::$plugin_name ),
		    'menu_name'             => __( 'Content Blocks', parent::$plugin_name ),
		    'name_admin_bar'        => __( 'Content Blocks', parent::$plugin_name ),
		    'parent_item_colon'     => __( 'Parent Block:', parent::$plugin_name ),
		    'all_items'             => __( 'All Blocks', parent::$plugin_name ),
		    'add_new_item'          => __( 'Add New Block', parent::$plugin_name ),
		    'add_new'               => __( 'Add New', parent::$plugin_name ),
		    'new_item'              => __( 'New Block', parent::$plugin_name ),
		    'edit_item'             => __( 'Edit Block', parent::$plugin_name ),
		    'update_item'           => __( 'Update Block', parent::$plugin_name ),
		    'view_item'             => __( 'View Block', parent::$plugin_name ),
		    'search_items'          => __( 'Search Blocks', parent::$plugin_name ),
		    'not_found'             => __( 'Not found', parent::$plugin_name ),
		    'not_found_in_trash'    => __( 'Not found in Trash', parent::$plugin_name ),
		    'items_list'            => __( 'Block list', parent::$plugin_name ),
		    'items_list_navigation' => __( 'Block list navigation', parent::$plugin_name ),
		    'filter_items_list'     => __( 'Filter block list', parent::$plugin_name ),
		);
		$args = array(
		    'label'                 => __( 'Content Block', parent::$plugin_name ),
		    'description'           => __( 'Content Blocks', parent::$plugin_name ),
		    'labels'                => $labels,
		    'supports'              => array( 'title', 'editor', 'revisions', ),
		    'hierarchical'          => true,
		    'public'                => true,
		    'show_ui'               => true,
		    'show_in_menu'          => true,
		    'menu_position'         => 20,
		    'menu_icon'             => 'dashicons-text',
		    'show_in_admin_bar'     => false,
		    'show_in_nav_menus'     => false,
		    'can_export'            => true,
		    'has_archive'           => false,
		    'exclude_from_search'   => true,
		    'publicly_queryable'    => false,
		    'capability_type'       => 'page',
		);
		register_post_type( self::$post_type, $args );
	}

	public function add_meta_boxes() {
		add_meta_box( 'block_attributes_metabox', __( 'Block Attributes', parent::$plugin_name ), array( $this, 'block_attributes_metabox' ), 'content_block', 'side', 'default', null );
		add_meta_box( 'block_background_metabox', __( 'Block Background', parent::$plugin_name ), array( $this, 'block_background_metabox' ), 'content_block', 'side', 'default', null );
	}

	public function block_attributes_metabox( $post ) {
		$templates = $this->get_templates();
		$selected  = get_post_meta( $post->ID, 'block_template', true );
		wp_nonce_field( 'block_attributes_meta_nonce', 'block_attributes_nonce' );
		include Utilities::path( 'partials/metaboxes/content_block_attributes.php' );
	}

	public function block_attributes_metabox_save( $post_id, $post ) {
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['block_attributes_nonce'] ) || !wp_verify_nonce( $_POST['block_attributes_nonce'], 'block_attributes_meta_nonce' ) ) {
			return;
		}
		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		update_post_meta( $post_id, 'block_template', sanitize_text_field( $_POST['block_template'] ) );
	}

	public function block_background_metabox( $post ) {
		// Background color
		$bgcolor = get_post_meta( $post->ID, 'background_color', true );
		$bgcolor = !empty( $bgcolor ) ? $bgcolor : '';
		// background image
		$bgimage = get_post_meta( $post->ID, 'background_image', true );
		$bgimage = !empty( $bgimage ) ? intval( $bgimage ) : '';
		// Default image
		$default = Utilities::url( 'images/default.jpg' );
		// Preview Image
		$preview = !empty( $bgimage ) ? wp_get_attachment_url( $bgimage ) : $default;
		// Nonce
		wp_nonce_field( 'block_background_meta_nonce', 'block_background_nonce' );
		// Markup
		include Utilities::path( 'partials/metaboxes/content_block_background.php' );
	}

	public function block_background_metabox_save( $post_id, $post ) {
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['block_background_nonce'] ) || !wp_verify_nonce( $_POST['block_background_nonce'], 'block_background_meta_nonce' ) ) {
			return;
		}
		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		update_post_meta( $post_id, 'background_color', sanitize_hex_color( $_POST['bgcolor'] ) );
		update_post_meta( $post_id, 'background_image', intval( $_POST['bgimage'] ) );
	}

	public function get_templates() {
		// Let themes, other functions, etc add templates
		$templates = apply_filters( 'content_block_templates', array() );
		// Make sure we got an array back
		$templates = is_array( $templates ) ? $templates : array();
		// Merge in our default
		$templates = wp_parse_args( array(
			'Default'      => Utilities::path( 'views/default_contents/default.php' ),
			'Page Section' => Utilities::path( 'views/content_blocks/section.php' ),
			'Content Only' => Utilities::path( 'views/content_blocks/content.php' ),
		), $templates );
		return $templates;
	}

	private function set_template( $block, $template ) {
		// Prefer template specified in $atts vs in post meta, so shortcodes / widgets can override what is set
		if( !empty( $template ) ) {
			$block->block_template = trim( $atts['template'] );
		}
		// Fallback to template specified on block, and finally to 'default'
		else {
			$block->block_template = !empty( $block->block_template ) ? $block->block_template : 'Default';
		}
		return $block;
	}

	private function extend_block( $block, $extra_classes = null ) {
		// Get extra data from database
		$block->background_image = get_post_meta( $block->ID, 'background_image', true );
		$block->background_color = get_post_meta( $block->ID, 'background_color', true );
		$block->block_template   = get_post_meta( $block->ID, 'block_template', true );
		// Make some decisions...
		$block->html_id     = strtolower( sanitize_html_class( $block->post_name, '' ) );
		$block->html_class  = !empty( $block->background_image ) ? ' has-background-image' : '';
		$block->html_class .= !empty( $block->background_color ) ? ' has-background-color' : '';
		$block->html_class .= !empty( $extra_classes ) ? ' ' . esc_attr( $extra_classes ) : '';
		// $block->html_style  = !empty( $block->background_image ) ? sprintf( ' style="background-image: url(%s);"', wp_get_attachment_url( $block->background_image ) ) : '';
		$block->html_style  = !empty( $block->background_color ) && empty( $block->html_style ) ? sprintf( ' style="background-color: %s;"', $block->background_color ) : '';
		$block->html_style  = !empty( $block->background_image ) ? sprintf( ' style="background-image: url(%s);"', wp_get_attachment_url( $block->background_image ) ) : $block->html_style;
		return $block;
	}

	public function output( $atts = array() ) {
		// Parse attributes with defaults
		$atts = shortcode_atts( self::$default_atts, $atts, 'content_block' );
		// If we don't have an id, let's bail
		if( !isset( $atts['id'] ) ) {
			return;
		}
		// If the specified post doesn't exist, let's bail
		if( !get_post_status( $atts['id'] ) ) {
			return;
		}
		// Get post from the database
		$block = $this->extend_block( get_post( $atts['id'], 'OBJECT', 'raw' ), $atts['class'] );

		// Set output templates
		$block = $this->set_template( $block, $atts['template'] );
		// Get all templates
		$templates = $this->get_templates();
		// Finally, output content
		if( isset( $templates[$block->block_template] ) && file_exists( $templates[$block->block_template] ) ) {
			include $templates[ $block->block_template ];
		}
	}

	public function get_output( $atts = array() ) {
		ob_start();
		$this->output( $atts );
		return ob_get_clean();
	}



}