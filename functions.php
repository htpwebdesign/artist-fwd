<?php
/**
 * Artist FWD functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Artist_FWD
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function artist_fwd_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Artist FWD, use a find and replace
		* to change 'artist-fwd' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'artist-fwd', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary Menu', 'artist-fwd' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'artist-fwd' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'artist_fwd_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'artist_fwd_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function artist_fwd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'artist_fwd_content_width', 640 );
}
add_action( 'after_setup_theme', 'artist_fwd_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function artist_fwd_scripts() {
	wp_enqueue_style( 'artist-fwd-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'artist-fwd-style', 'rtl', 'replace' );

	wp_enqueue_script( 'artist-fwd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'artist-fwd-accordion', get_template_directory_uri() . '/js/accordion.js', array(), _S_VERSION, true );

	if(is_post_type_archive( 'artist-events' )){
		wp_enqueue_script( 'artist-fwd-google-key', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyATzLvecNFYJ9ZoVr-bW3MNUxS7Cfd9vw4' );
		wp_enqueue_script( 'artist-fwd-google-maps', get_template_directory_uri() . '/js/google-map.js', array(), _S_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'artist_fwd_scripts' );

/**
 * Custom Post Types & Taxonomies
 */
require get_template_directory() . '/inc/cpt-tax.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Google Maps API.
 */
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyATzLvecNFYJ9ZoVr-bW3MNUxS7Cfd9vw4';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
	return array(
	  'width'  => 300,
	  'height' => 300,
	  'crop'   => 1,
	);
});




# Presentation

// 1. How to eliminate Dashboard widgets and add your own widgets like Tutorial links / video 
// without a plugin.

// https://developer.wordpress.org/apis/dashboard-widgets/



// i. eliminate dashboard widgets

//removing default dashboard widgets
// To remove dashboard widget, use the remove_meta_box()  function.
// remove_meta_box( string $id, string|array|WP_Screen $screen, string $context )

//default widget names

/*
// Main column (left): 
// Browser Update Required
$wp_meta_boxes['dashboard']['normal']['high']['dashboard_browser_nag']; 
// PHP Update Required
$wp_meta_boxes['dashboard']['normal']['high']['dashboard_php_nag']; 

// At a Glance
$wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
// Right Now
$wp_meta_boxes['dashboard']['normal']['core']['network_dashboard_right_now'];
// Activity
$wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'];
// Site Health Status
$wp_meta_boxes['dashboard']['normal']['core']['health_check_status'];

// Side Column (right): 
// WordPress Events and News
$wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'];
// Quick Draft, Your Recent Drafts
$wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']; 

*/

// REMOVING QUICK DRAFT
/*
// Create the function to use in the action hook
function wporg_remove_dashboard_widget() {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
} 
// Hook into the 'wp_dashboard_setup' action to register our function
add_action( 'wp_dashboard_setup', 'wporg_remove_dashboard_widget' );

*/


// ii. create custom dashboard widget

/*

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
  
function my_custom_dashboard_widgets() {

// Globalize the metaboxes array, this holds all the widgets for wp-admin.
global $wp_meta_boxes;

// wp_add_dashboard_widget( $widget_id, $widget_name, $callback, $control_callback, $callback_args );
 
wp_add_dashboard_widget('custom_links_widget', 'Org VS Com', 'custom_dashboard_links');
}
 
function custom_dashboard_links() {
	
echo '
<a href="https://www.youtube.com/watch?v=Z1ND4HeGj3o"> Link to video</a>
';
}

*/




// 2. How to eliminate, rename, and reorder Dashboard menu items without a plugin.


// i. eliminate dashboard menu items

// //https://developer.wordpress.org/reference/functions/remove_menu_page/

/*
function remove_menus() {
	remove_menu_page('edit-comments.php'); 

}
add_action('admin_menu', 'remove_menus');
*/





// ii. rename  menu items

// https://developer.wordpress.org/reference/functions/add_menu_page/
// Default: bottom of menu structure

    // 2 – Dashboard
    // 4 – Separator
    // 5 – Posts
    // 10 – Media
    // 15 – Links
    // 20 – Pages
    // 25 – Comments
    // 59 – Separator
    // 60 – Appearance
    // 65 – Plugins
    // 70 – Users
    // 75 – Tools
    // 80 – Settings
    // 99 – Separator

	
/*
function rename_admin_menu_items() {
	global $menu; 

	//rename submenu 
	global $submenu; 
	
	//wp-admin > menu.php

// print_r($menu);

	$menu[10][0]= 'demo';

// to find the page, refer back to https://developer.wordpress.org/reference/functions/remove_menu_page/
	$submenu['upload.php'][5][0] = "media changed";
}

add_action ('admin_menu', 'rename_admin_menu_items');
*/


//iii. reorder menu items


// // add_filter( string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1 )

// // (accepted arguments in the function)




/*
function custom_menu_order( $menu_ord ) {
	
	     if ( !$menu_ord ) return true;
	
	     return array(
		
		          'index.php', // Dashboard
		
		          'edit.php?post_type=page', // Pages
		
		          'edit.php', // Posts
		
		     );
		
		}
	
	add_filter( 'custom_menu_order', 'custom_menu_order', 10, 1 );
		
	add_filter( 'menu_order', 'custom_menu_order', 10, 1 );

	*/