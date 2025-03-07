<?php
/**
 * vandco functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vandco
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

$global_access_wholesale = true;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vandco_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on vandco, use a find and replace
		* to change 'vandco' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'vandco', get_template_directory() . '/languages' );

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
			'main-nav' => esc_html__( 'Primary', 'vandco' ),
			'utility-nav' => esc_html__( 'Utility', 'vandco' ),
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
			'vandco_custom_background_args',
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
add_action( 'after_setup_theme', 'vandco_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vandco_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vandco_content_width', 640 );
}
add_action( 'after_setup_theme', 'vandco_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vandco_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'vandco' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'vandco' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'vandco_widgets_init' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {

		wp_enqueue_style(
			'vandco-style',
			get_stylesheet_directory_uri() . '/dist/css/main.css',
			array(),
			time(),
		);
		//add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

function enqueue_custom_gutenberg_script() {
	wp_enqueue_script(
		'custom-admin-js',
		get_stylesheet_directory_uri() . '/src/scripts/admin.js',
		array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' ),
		null,
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'enqueue_custom_gutenberg_script' );


// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */

function site_enqueue_scripts() {
	wp_enqueue_style( 'Fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false );
	
	wp_enqueue_style(
		'vandco-style',
		get_stylesheet_directory_uri() . '/dist/css/main.css',
		array(),
		time(),
	);

	wp_enqueue_script( 'main', get_template_directory_uri() . '/dist/js/main.js', array(), time(), true );

	wp_enqueue_style('Quicksand-fonts', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap', false);

	// Modaal POPUP
	wp_enqueue_script('modaal-js', 'https://cdn.jsdelivr.net/npm/modaal@0.4.4/dist/js/modaal.min.js', array('jquery'), '0.4.4', true);
	wp_enqueue_style('modaal-css', 'https://cdn.jsdelivr.net/npm/modaal@0.4.4/dist/css/modaal.min.css', array(), '0.4.4', 'all');

	//Swiper JS
	wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', array(), '0.4.4', 'all');
	wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array('jquery'), '0.4.4', true);


}
add_action( 'wp_enqueue_scripts', 'site_enqueue_scripts' );

function custom_excerpt_length($length) {
    return 10; // Change the number to your desired length
}
add_filter('excerpt_length', 'custom_excerpt_length');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * ACF Customizer additions.
 */
require get_template_directory() . '/inc/admin-settings.php';

/**
 * Register Blocks on Gutenberg.
 */
require get_template_directory() . '/inc/register-blocks.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * inc folder
 */
require get_template_directory() . '/inc/menu.php';
require get_template_directory() . '/inc/blog-template.php';
require get_template_directory() . '/inc/customize.php';

