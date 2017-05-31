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
    		'masthead-widget-area' => array(
    			'name'          => __( 'Masthead Content Widgets', 'mpress-child' ),
    			'id'            => 'masthead-widget-area',
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget'  => "</div>",
    			'before_title'  => '<h4 class="widget-title">',
    			'after_title'   => '</h4>'
    		),

    		'off-canvas-widgets' => array(
    			'name'          => __( 'Off Canvas Widgets', 'mpress-child' ),
    			'id'            => 'off-canvas-widgets',
    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
    			'after_widget'  => "</div>",
    			'before_title'  => '<h4 class="widget-title">',
    			'after_title'   => '</h4>'
    		),

    		'footer-widgets-left' => array(
	    		'name'          => __( 'left Footer Widgets', 'mpress-child' ),
	    			'id'            => 'footer-widgets-left',
	    			'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    			'after_widget'  => "</div>",
	    			'before_title'  => '<h4 class="widget-title">',
	    			'after_title'   => '</h4>'
    		),

    		'footer-widgets-right' => array(
	    		'name'          => __( 'Right Footer Widgets', 'mpress-child' ),
	    			'id'            => 'footer-widgets-right',
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
		$icons['toggle-sub-menu'] = 'icon fa fa-angle-down';
		return $icons;
	}
	// Uncomment to use
	add_filter( 'mpress_font_icons', 'add_font_icons' );
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

function jackrabbit_embed_schedule( $atts = array() ) {

	$schedules = get_jackrabbit_schedule( $atts );

	foreach( $schedules as $index => $schedule ) {
		$output  = '<div class="jackrabbit_table_wrapper"><table class="openings jackrabbit">';
		$output .= '<thead>';
			$output .= '<tr>';
			foreach( $schedule['th'] as $th ) {
				// Do some replacements
				$th = str_ireplace( '<td>', '<th>', $th );
				$th = str_ireplace( '</td>', '</th>', $th );
				$output .= $th;
			}
			$output .= '</tr>';
		$output .= '</thead>';
		$output .= '<tbody>';
		foreach( $schedule['tr'] as $tr ) {
			$output .= $tr;
		}
		$output .= '</tbody></table></div>';
		// Replace bold styles
		$output = str_ireplace( '<b>', '', $output );
		$output = str_ireplace( '</b>', '', $output );
		// return the table
		return $output;
	}
}
add_shortcode( 'jackrabbit_schedule', 'jackrabbit_embed_schedule' );

function get_jackrabbit_schedule( $atts = array() ) {
	// Parse attributes
	$atts = shortcode_atts( array(
		'id'       => '33933',
		'cat1'     => null,
		'sort'     => 'class',
		'hidecols' => null,
	), $atts, 'jackrabbit_schedule' );
	// Set up schedules array
	$schedules = array();
	// If we don't have a client ID, we can bail...
	if( empty( $atts['id'] ) ) {
		return $schedules;
	}
	$request = 'https://app.jackrabbitclass.com/OpeningsDirect.asp';
	foreach( $atts as $key => $att ) {
		// If our att is empty, move on...
		if( empty( $att ) ) {
			continue;
		}
		$request = add_query_arg( $key, $att, $request );
	}
	// Get the data
	$response = wp_remote_get( $request );
	// If we had an error, we can bail
	if( is_wp_error( $response ) || empty( $response ) ) {
		return $schedules;
	}
	// Set up a new DOM Document
	$dom = new DOMDocument( '1.0', 'UTF-8' );
	// Set error level to suppress minor warnings in HTML formatting
	$internalErrors = libxml_use_internal_errors( true );
	// Load the HTML from the response
	$dom->loadHTML( '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $response['body'] );
	// Restore error level
	libxml_use_internal_errors( $internalErrors );
	// Get all the tables
	$tables = $dom->getElementsByTagName( 'table' );
	// Set all the tables (should be 1, but we want to be sure if there are more)
	if( $tables->length ) {
		foreach( $tables as $table ) {
			$schedules[] = set_jackrabbit_schedule_formatting( $dom->saveHTML( $table ) );
		}
	}
	// Return the schedules
	return $schedules;
}

function set_jackrabbit_schedule_formatting( $table ) {
	// Set up a new DOM Document
	$dom = new DOMDocument( '1.0', 'UTF-8' );
	// Set error level to suppress minor warnings in HTML formatting
	$internalErrors = libxml_use_internal_errors( true );
	// Load the HTML from the response
	$dom->loadHTML( '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $table );
	// Restore error level
	libxml_use_internal_errors( $internalErrors );
	// Get rows
	$rows = $dom->getElementsByTagName( 'tr' );
	// Array to hold classes, new headings
	$classes  = array();
	// Reset our table variable to what we want
	$table = array(
		'th' => array(),
		'tr' => array(),
	);
	if( $rows->length ) {
		foreach( $rows as $rowIndex => $row ) {
			$cells = array();
			$blank = array();
			$cellCount = 0;
			$row->removeAttribute( 'style' );
			foreach( $row->childNodes as $cellIndex => $cell ) {
				// If this is not a TD...
				if( $cell->nodeName !== 'td' ) {
					continue;
				}
				// If it's a display none cell, lets just remove it...
				if( $cell->getAttribute( 'style' ) === 'display:none' ) {
					$blank[] = $cell;
					continue;
				}
				if( htmlentities( $cell->nodeValue, null, 'utf-8' ) === '&nbsp;' ) {
					$cell->nodeValue = 'Not Available';
				}
				// If this is the first row, GET classes
				if( $rowIndex === 0 ) {
					$classes[$cellCount] = strtolower( preg_replace( '/\s+/', '', $cell->textContent ) );
					$table['th'][] = $dom->saveHTML( $cell );
				}

				// Else SET classes
				else {
					// Clear inline styles
					$cell->removeAttribute( 'style' );
					if( isset( $classes[$cellCount] ) ) {
						$cell->setAttribute( 'class', $classes[$cellCount] );
					}
				}
				++$cellCount;
			}
			// Remove display none cells
			foreach( $blank as $empty ){
			  $empty->parentNode->removeChild( $empty );
			}
			// If this is NOT the first row, save row
			if( $rowIndex !== 0 ) {
				$table['tr'][] = $dom->saveHTML( $row );
			}
		}

	}
	return $table;

	// return $dom->saveHTML( $dom->documentElement );
}

include_once CHILD_THEME_ROOT_DIR . 'includes/class_sidebar_walker_nav_menu.php';

/**
 * Function to remove automatic placement of sharing buttons from jetpack
 */
if( !function_exists( 'jptweak_remove_share' ) ) {
	function jptweak_remove_share() {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
		if ( class_exists( 'Jetpack_Likes' ) ) {
			remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
		}
	}
	add_action( 'loop_start', 'jptweak_remove_share' );
}
/**
 * Function to manually place the sharing buttons from jetpack wherever we want
 */
if( !function_exists( 'jptweak_place_share' ) ) {
	function jptweak_place_share() {
		if ( function_exists( 'sharing_display' ) ) {
			sharing_display( '', true );
		}
		if ( class_exists( 'Jetpack_Likes' ) ) {
			$custom_likes = new Jetpack_Likes;
			echo $custom_likes->post_likes( '' );
		}
	}
	add_action( 'jp_share_buttons', 'jptweak_place_share' );
}
add_filter('excerpt_more','__return_false');
if( !function_exists( 'customize_image_sizes' ) ) {
	function customize_image_sizes() {
		// 16:9 Featured image size for the post thumbnail on the blog page
		add_image_size( 'gymfinity-featured-small', '300', '170', true );
	}
	add_action( 'init', 'customize_image_sizes' );
}

