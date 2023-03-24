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
			'menu-1' => esc_html__( 'Primary', 'artist-fwd' ),
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

function acf_make_map( $acf_map_field ){
	$address_field = $acf_map_field['address'];
    $encoded_address = urlencode( $address_field );
    echo '
        <iframe
            width="600"
            height="450"
            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD1k2HJ2MXMKWyjPD4_NeXqTmBLPWgKRZU&q=' . $encoded_address . '" allowfullscreen>
        </iframe>';
}