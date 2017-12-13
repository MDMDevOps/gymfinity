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
			'masthead-widget-area-home' => array(
				'name'          => __( 'Homepage Masthead Content Widgets', 'mpress-child' ),
				'id'            => 'masthead-widget-area-home',
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
			'after-cart-widget' => array(
				'name'          => __( 'After Cart Widget', 'mpress-child' ),
					'id'            => 'after-cart-widget',
					'before_widget' => '',
					'after_widget'  => "",
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>'
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

//Remove woocommerce breadcrumbs, we got some bread already
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_filter('woocommerce_product_description_heading', '__return_null');

//Remove Woocommerce title and add it full length
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5);

//Change description go under image
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_excerpt', 20);

//Adding the description to categories page



//Remove SKU and Category
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_filter('woocommerce_product_description_heading', '__return_null');


//Restructure the single view for a product
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

//remove upsell products on lower part of page
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

add_filter( 'woocommerce_subcategory_count_html', 'jk_hide_category_count' );
function jk_hide_category_count() {
	// No count
}

function show_product_category_description( $category ) {
	//echo $category->description;
}
add_action( 'woocommerce_after_subcategory', 'show_product_category_description' );

function main_column_classes() {
	echo 'column sm-7 sm-push-5 lg-8 lg-push-4';
}
add_action( 'main_column_classes', 'main_column_classes' );

function sidebar_column_classes() {
	echo 'column sm-5 sm-pull-7 lg-4 lg-pull-8';
}
add_action( 'sidebar_column_classes', 'sidebar_column_classes' );


/**
 * Use docblock syntax for docbloks
 * @see https://phpdoc.org/docs/latest/guides/docblocks.html
 */

/**
 * Add taxonomy to testimonials.
 * Registers the 'post_tag' taxonomy to post type of jetpack-testimonials
 */
function add_categories_to_cpt(){
	register_taxonomy_for_object_type( 'post_tag' , 'jetpack-testimonial' );
}
add_action( 'init','add_categories_to_cpt' );
/**
 * Add taxonomy to testimonials.
 * Registers the 'post_tag' taxonomy to post type of jetpack-testimonials
 */
function create_testimonial_shortcode( $atts = array() ){ // array() was spelled wrong
	// $atts = shortcode_atts( array(
	//        'post_type' =>    'jetpack-testimonial',
	//        'id'       => 'id',
	//        'post_tag'    => 'tag'
	//     ), $atts );

	/**
	 * Fix $atts parser.
	 * 1. Fix indentation and formatting
	 * 2. Remove 'post_type' att so users can't override which post type you are pulling
	 * 3. Change id and post_tag default to null, should accept a comma seperated list that will be parsed into an array
	 * 		with the current config, if a user DOESN'T pass an ID you will never get any results, because it will look for id='ID'...and no post has that, same with the tag
	 * 4. Added shortcode identifier for filtering
	 */
	$atts = shortcode_atts( array(
		'id' => null,
		'post_tag' => null,
		'class' => null,
	), $atts, 'mdm_testimonial' );

	/**
	 * Function to parse args.
	 * May require multiple functions to parse different kinds of args
	 */
	$query_args = mdm_testimonials_parse_query_args( $atts ); // Do stuff here to parse

	/**
	 * Passing $query_args instead of $atts.
	 * $atts are shortcode attributes, and shouldn't be fully passed to WP_Query.
	 * Instead, sanitize / format the arguments that belong to WP_Query only
	 * Also renamed to wp_query instad of the_query
	 */

	$wp_query = new WP_Query( $query_args );

	ob_start();

	if ( $wp_query ->have_posts() ) :

		//Sprintf to add wrapper and class
		echo sprintf( '<div class="testimonial-wrapper%s">', !empty( $atts['class']) ? ' ' . esc_attr($atts['class']) : '');

		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			get_template_part( 'views/content', 'testimonials' );
		endwhile;

		echo '</div>';
	endif;

	/**
	 * Reset global postdata
	 * @see https://codex.wordpress.org/Function_Reference/wp_reset_postdata
	 */
	wp_reset_postdata();

	return ob_get_clean();
	/**
	 * Returning $atts won't do anything at all. Those are shortcode attributes.
	 * Somewhere between defining $wp_query and return, you have to use the results from the query, capture the content
	 * in an output buffer, and return the content
	 */
	// return $atts;
}
add_shortcode( 'mdm_testimonial', 'create_testimonial_shortcode' );


if( !function_exists( 'mdm_testimonials_parse_query_args' ) ) {
	function mdm_testimonials_parse_query_args( $atts ) {
		// Setup immutable defaults

		$query_args = array(
			'post_type' => array( 'jetpack-testimonial' ),
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);


		/**
		 * Adding the id atts
		 * Creating them into an array and then into an interger
		 */
		if( !empty( $atts['id'] ) && is_string( $atts['id'] ) ) {
			// Explode the string
			$ids = explode( ',', $atts['id'] );
			// Get the intvals

			foreach ($ids as $index => $id) {
				$ids[$index] = intval($id);
			}

			// Assign
			$query_args['post__in'] = $ids;
		}

		/**
		 * Adding the tag atts
		 * Creating them into an array
		 */
		if( !empty( $atts['post_tag'] ) && is_string( $atts['post_tag'] ) ) {

			$tags = array_map( 'trim', explode( ',', $atts['post_tag'] ) );

			$query_args['tag_slug__in'] = $tags;
		}
		// Return
		return $query_args;
	}
}


// //Created Staff Shortcode
// function create_staff_shortcode( $atts = array() ){

// 	//Creating attributes for shortcode
// 	$atts = shortcode_atts( array(), $atts, 'staff_list' );


// 	$query_args = mdm_staff_parse_query_args( $atts ); // Do stuff here to parse

// 	$wp_query = new WP_Query( $query_args );

// 	ob_start();

// 	if ( $wp_query ->have_posts() ) :

// 		while ( $wp_query->have_posts() ) : $wp_query->the_post();
// 			get_template_part( 'views/content', 'content-staff' );
// 		endwhile;
// 		endif;

// 		*
// 		* Reset global postdata
// 		* @see https://codex.wordpress.org/Function_Reference/wp_reset_postdata
// 		*
// 		wp_reset_postdata();

// 		return ob_get_clean();
// }

// add_shortcode( 'staff_list', 'create_staff_shortcode' );


// if( !function_exists('mdm_staff_parse_query_args') ) {
// 	function mdm_staff_parse_query_args( $atts ) {
// 		$query_args = array(
// 			'post_type' => array( 'staff' ),
// 			'post_status' => 'publish',
// 			'posts_per_page' => -1,
// 			'orderby' => 'menu_order',
// 			'order' => 'DESC',
// 		);

// 		return $query_args;
// 	}
// }


//Insert arg Filter staff by menu order
add_filter( 'posts_orderby' , 'staff_cpt_order' );

function staff_cpt_order( $orderby ) {
	global $wpdb;

	// Check if the query is for an archive
	if ( is_archive() && get_query_var("post_type") == "staff" ) {
		// Query was for archive, then set order
		return "$wpdb->posts.menu_order DESC";
	}
	return $orderby;
}

// function custom_booking_price() {
// 	$product = wc_get_product();
// 	// var_dump($product);
// 	// $target_product_types = array(
// 	// 	'booking'
// 	// );
// 	$price = '';
// 	$price .= wc_price( $product->get_price() ) . ' Deposit due today.';
// 	$price .= wc_price( ( $product->get_price() * 10 ) ) . 'Due on day of party.';

// 	echo $price;
// 	// if ( in_array ( $product->product_type, $target_product_types ) ) {
// 	// 	// if variable product change price output
// 	// 	$price = '';
// 	// 	$price .= woocommerce_price( $product->get_price() ) . ' per person';
// 	// 	return $price;
// 	// }
// 	// return normal price
// 	// return $price;
// }

// add_action( 'wc_deposit_theme', 'custom_booking_price', 10, 2);
function woo_featured_before_cart() {
	if ( is_active_sidebar( 'after-cart-widget' ) ) :
       dynamic_sidebar( 'after-cart-widget' );
	endif;
}
add_action( 'woocommerce_after_cart_table', 'woo_featured_before_cart' );






