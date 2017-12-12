<?php

namespace Mdm\Gymfinity\Posts;

use \Mdm\Gymfinity\Utilities as Utilities;

class Staff extends \Mdm\Gymfinity {

	public static function register() {
		$labels = array(
			'name'                  => _x( 'Staff', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Staff', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Staff', 'text_domain' ),
			'name_admin_bar'        => __( 'Staff', 'text_domain' ),
			'archives'              => __( 'Staff Archives', 'text_domain' ),
			'attributes'            => __( 'Staff Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Staff:', 'text_domain' ),
			'all_items'             => __( 'All Staff', 'text_domain' ),
			'add_new_item'          => __( 'Add New Staff', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Staff', 'text_domain' ),
			'edit_item'             => __( 'Edit Staff', 'text_domain' ),
			'update_item'           => __( 'Update Staff', 'text_domain' ),
			'view_item'             => __( 'View Staff', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
			'search_items'          => __( 'Search Staff', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into staff', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this staff', 'text_domain' ),
			'items_list'            => __( 'Staff list', 'text_domain' ),
			'items_list_navigation' => __( 'Staff list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter staff list', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                  => 'staff',
			'with_front'            => true,
			'pages'                 => false,
			'feeds'                 => false,
		);
		$args = array(
			'label'                 => __( 'Staff', 'text_domain' ),
			'description'           => __( 'Staff Profiles', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-groups',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
		);
		register_post_type( 'staff', $args );
	}

	public function add_meta_boxes() {
		add_meta_box( 'staff_position', __( 'Position', parent::$plugin_name ), array( $this, 'staff_position_metabox' ), 'staff', 'normal', 'high', null );
	}

	public function staff_position_metabox( $post ) {
		$position  = get_post_meta( $post->ID, 'staff_position', true );
		wp_nonce_field( 'staff_position_meta_nonce', 'staff_position_nonce' );
		printf( '<input type="text" class="widefat" id="staff_position" name="staff_position" value="%s">', esc_attr( $position ) );
	}

	public function save_metabox( $post_id, $post ) {
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['staff_position_nonce'] ) || !wp_verify_nonce( $_POST['staff_position_nonce'], 'staff_position_meta_nonce' ) ) {
			return;
		}
		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		update_post_meta( $post_id, 'staff_position', sanitize_text_field( $_POST['staff_position'] ) );
	}

	public function output_staff_position() {
		global $post;
		$position  = get_post_meta( $post->ID, 'staff_position', true );
		echo esc_attr( $position );
	}
}