<?php
/*******************************************************************************
 *                 ______                 __  _
 *                / ____/_  ______  _____/ /_(_)___  ____  _____
 *               / /_  / / / / __ \/ ___/ __/ / __ \/ __ \/ ___/
 *              / __/ / /_/ / / / / /__/ /_/ / /_/ / / / (__  )
 *             /_/    \__,_/_/ /_/\___/\__/_/\____/_/ /_/____/
 *
 ******************************************************************************/

/**
 * Functions
 * Boostrap all custom functions that our theme needs to run
 * @package mpress-child
 * @see     https://codex.wordpress.org/Functions_File_Explained
 * @since   version 1.0.0
 */

/**
 * Define constants
 * Must be different than the constants used in the MPRESS PARENT
 * @since version 1.0.1
 */

define( 'CHILD_THEME_ROOT_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'CHILD_THEME_ROOT_URI', trailingslashit( get_stylesheet_directory_uri() ) );

/* -------------------------------------------------------------------------- */

/**
 * HERE YOU CAN PASTE FUNCTIONS YOU WANT TO REPLACE, OR ADD FILTERS / ACTIONS TO SUPPLEMENT EXISTING FUNCTIONS
 * AS TIME GOES ON, WE WILL BEGIN ADDING FILTER / ACTION HOOKS TO ALL FUNCTIONS, SO THEY WON'T NEED REPLACED
 */

 /**
 * Hook into parent theme stylesheet uri. If registering addition stylesheets, can add the dependencies here
 * Parent theme handles enqueueing styles, child replaces URI of stylesheet so both aren't enqueued
 * If both are desired, replace with standard register / enqueue function
 * @since version 1.0.0
 */
if ( !function_exists( 'register_public_stylesheets' ) ) {
    function register_public_stylesheets( $stylesheets ) {
    	// Enqueue Google Fonts
    	$stylesheets['google-fonts'] = array(
    		'src'   => '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
    		'deps'  => array(),
    		'ver'   => '1.0.0',
    		'media' => 'all',
    	);
    	// Enqueue main stylesheet from child instead of parent
    	$stylesheets['mpress-public'] = array(
    		'src'   => CHILD_THEME_ROOT_URI . 'styles/dist/public.min.css',
    		'deps'  => array( 'FontAwesome', 'google-fonts' ),
    		'ver'   => '1.0.0',
    		'media' => 'all',
    	);
    	return $stylesheets;
    }
    add_filter( 'mpress_public_stylesheets', 'register_public_stylesheets' );
}
/* -------------------------------------------------------------------------- */
if ( !function_exists( 'register_admin_stylesheets' ) ) {
    function register_admin_stylesheets( $stylesheets ) {
    	// Enqueue Google Fonts
    	$stylesheets['gymfinity-admin'] = array(
    		'src'   => CHILD_THEME_ROOT_URI . 'styles/dist/admin.min.css',
    		'deps'  => array(),
    		'ver'   => '1.0.0',
    		'media' => 'all',
    	);
    	return $stylesheets;
    }
    add_filter( 'mpress_admin_stylesheets', 'register_admin_stylesheets' );
}
/* -------------------------------------------------------------------------- */

function register_editor_stylesheets( $stylesheets ) {
	$stylesheets[] = CHILD_THEME_ROOT_URI . 'styles/dist/editor.min.css';
	return $stylesheets;
}
add_filter( 'mpress_editor_stylesheets', 'register_editor_stylesheets' );

/* -------------------------------------------------------------------------- */

function register_public_scripts( $scripts ) {
	$scripts['gymfinity-public'] = array(
		'src'    => CHILD_THEME_ROOT_URI . 'scripts/dist/public.min.js',
		'deps'   => array( 'jquery', 'mpress-public' ),
		'ver'    => '1.0.0',
		'footer' => true,
		'localize' => true,
	);
	return $scripts;
}
add_filter( 'mpress_public_scripts', 'register_public_scripts' );

/* -------------------------------------------------------------------------- */

if( !function_exists( 'register_admin_scripts' ) ) {
	function register_admin_scripts( $scripts ) {
		$scripts['gymfinity-admin'] = array(
			'src'    => CHILD_THEME_ROOT_URI . 'scripts/dist/admin.min.js',
			'deps'   => array( 'jquery' ),
			'ver'    => '1.0.0',
			'footer' => true,
			'localize' => false,
		);
		return $scripts;
	}
	add_filter( 'mpress_admin_scripts', 'register_admin_scripts' );
}

/* -------------------------------------------------------------------------- */

/**
 * Register Widget Area(s)
 * Override or extend Parent Widget Areas
 * @since version 1.0.0
 * @see   http://codex.wordpress.org/Widgetizing_Themes
 */
if( !function_exists( 'mpress_add_sidebars' ) ) {
    function register_child_sidebars( $sidebars ) {
    	$child_sidebars = array(
    		'top-banner-widgets' => array(
    			'name'          => __( 'Top Banner Widgets', 'mpress-child' ),
    			'id'            => 'top-banner-widgets',
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget'  => "</div>",
    			'before_title'  => '<h4 class="widget-title">',
    			'after_title'   => '</h4>'
    		),

    		'footer-widgets' => array(
	    		'name'          => __( 'Footer Widgets', 'mpress-child' ),
	    			'id'            => 'footer-widgets',
	    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    			'after_widget'  => "</div>",
	    			'before_title'  => '<h4 class="widget-title">',
	    			'after_title'   => '</h4>'
    		),
    	);
    	return array_merge( $sidebars, $child_sidebars );
    }
    // Uncomment to use
    add_filter( 'mpress_sidebars', 'register_child_sidebars' );
}

/* -------------------------------------------------------------------------- */

if( !function_exists( 'register_child_menus' ) ) {
	function register_child_menus( $menus ) {
		$menus = array(
			'primary-navbar'    => __( 'Primary Nav Bar', 'mpress-child' ),
			'secondary-navbar'  => __( 'Secondary Nav Bar', 'mpress-child' ),
		);
		return $menus;
	}
	// Uncomment to use
	add_filter( 'mpress_menus', 'register_child_menus' );
};
/* -------------------------------------------------------------------------- */

/**
 * Adds editor formats to the tinymce editor
 */
if( !function_exists( 'add_editor_formats' ) ) {
	function add_editor_formats( $formats ) {
		// Example to add cursive class
		$formats['inline']['items'][] = array(
		    'title'   => 'Cursive',
		    'classes' => 'cursive',
		    'inline' => 'span',
		    'wrapper' => false,
		);
		return $formats;
	}
	// Uncomment to use
	// add_filter( 'mpress_style_formats', 'add_editor_formats', 10, 1 );
}
/* -------------------------------------------------------------------------- */

/**
 * Adding icon fonts to the list of icons
 */
if( !function_exists( 'add_font_icons' ) ) {
	function add_font_icons( $icons ) {
		$icons['scrolltop'] = 'icon fa fa-angle-up';
		return $icons;
	}
	// Uncomment to use
	// add_filter( 'mpress_font_icons', 'add_font_icons' );
}


/**
 * Add Theme presets
 * HTML Files you want to have available to the tinymce editor
 */
if( !function_exists( 'theme_presets' ) ) {
	function theme_presets( $presets ) {
		$presets[ 'Example' ] = CHILD_THEME_ROOT_DIR . 'templates/presets/example.php';
		return $presets;
	}
	// Uncomment to use
	//add_filter( 'theme_presets', 'theme_presets', 10, 1 );
}


/**
 * Extend the base MPress theme engine
 */
if( !function_exists( 'extend_mpress_theme_engine' ) ) {
	function extend_mpress_theme_engine( $modules ) {
		$modules['Theme_Name_Example']   = CHILD_THEME_ROOT_DIR . 'includes/class_theme_name_example.php';
		return $modules;
	}
	// Uncomment ot use
	//add_filter( 'mpress_theme_modules', 'extend_mpress_theme_engine' );
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

