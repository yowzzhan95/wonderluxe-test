<?php
/**
 * Wonderluxe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wonderluxe
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
function wonderluxe_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Wonderluxe, use a find and replace
		* to change 'wonderluxe' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wonderluxe', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'wonderluxe' ),
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
			'wonderluxe_custom_background_args',
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
add_action( 'after_setup_theme', 'wonderluxe_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wonderluxe_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wonderluxe_content_width', 640 );
}
add_action( 'after_setup_theme', 'wonderluxe_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wonderluxe_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wonderluxe' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wonderluxe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wonderluxe_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wonderluxe_scripts() {
	wp_enqueue_style( 'wonderluxe-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wonderluxe-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wonderluxe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'wonderluxe-slider', get_template_directory_uri() . '/js/custom_slider.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wonderluxe_scripts' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action('wpcf7_before_send_mail', 'save_enquiry_form_submission');

function save_enquiry_form_submission($contact_form) {
	// Retrieve the Contact Form 7 Plugin instance
    $submission = WPCF7_Submission::get_instance();
	
    if ($submission) {
		// Retrieve user submitted data
        $posted_data = $submission->get_posted_data();
        
        // Insert and retrieve a new Enquiry post type
        $post_id = wp_insert_post(array(
            'post_title'  => $posted_data['full_name'], // Use the Name field as the title
            'post_type'   => 'enquiry',
            'post_status' => 'publish',
        ));
        
        if ($post_id) {
            // Update Enquiry custom fields in the Enquiry post type with the submitted data
            update_field('name', $posted_data['full_name'], $post_id);
            update_field('contact_number', $posted_data['contact_number'], $post_id);
            update_field('email', $posted_data['email'], $post_id);
            update_field('message', $posted_data['message'], $post_id);
        }
    }
}

add_filter('wp_nav_menu_items','add_last_nav_item', 10, 2);

function add_last_nav_item($items, $args) {
	if ($args->menu_id == "4")
		return $items .= '<li><a href="#" role="button"><img src="' . home_url("/") . 'wp-content/uploads/2024/09/camera_2.png" /></a></li>';
	
	return $items;
}

add_shortcode('custom_slider', 'add_slider_shortcode');

function add_slider_shortcode() {
	return '
		<div class="slider-container">
			<div class="slider-wrapper">
				<div class="slide">
					<section class="wp-block-group about-us-container-small home-giveaways-section mb-5-5rem is-nowrap is-layout-flex wp-container-core-group-is-layout-5 wp-block-group-is-layout-flex">
						<div class="wp-block-columns w-max about-us-section pl-2rem home-slider is-layout-flex wp-container-core-columns-is-layout-5 wp-block-columns-is-layout-flex">
							<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
								<h2 class="wp-block-heading  secondary-title text-center">Destination</h2>
								<p class="container desc my-2rem">Forem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. </p>
								<p class="container desc my-2rem">Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
								<p class="container desc my-2rem">Class aptent taciti sociosqu ad. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus nisl, eu tempor urna.</p>
							</div>
							<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
								<figure class="wp-block-image size-full">
									<img decoding="async" width="860" height="754" src="' . home_url('/') . 'wp-content/uploads/2024/09/homepage-4.png" alt="" class="wp-image-357">
								</figure>
							</div>
						</div>
					</section>
				</div>
				<div class="slide">
					<section class="wp-block-group about-us-container-small home-giveaways-section mb-5-5rem is-nowrap is-layout-flex wp-container-core-group-is-layout-5 wp-block-group-is-layout-flex">
						<div class="wp-block-columns w-max about-us-section pl-2rem home-slider is-layout-flex wp-container-core-columns-is-layout-5 wp-block-columns-is-layout-flex">
							<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
								<h2 class="wp-block-heading  secondary-title text-center">Destination</h2>
								<p class="container desc my-2rem">Forem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. </p>
								<p class="container desc my-2rem">Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
								<p class="container desc my-2rem">Class aptent taciti sociosqu ad. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus nisl, eu tempor urna.</p>
							</div>
							<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
								<figure class="wp-block-image size-full">
									<img decoding="async" width="860" height="754" src="' . home_url('/') . 'wp-content/uploads/2024/09/homepage-4.png" alt="" class="wp-image-357">
								</figure>
							</div>
						</div>
					</section>
				</div>
				<div class="slide">
					<section class="wp-block-group about-us-container-small home-giveaways-section mb-5-5rem is-nowrap is-layout-flex wp-container-core-group-is-layout-5 wp-block-group-is-layout-flex">
						<div class="wp-block-columns w-max about-us-section pl-2rem home-slider is-layout-flex wp-container-core-columns-is-layout-5 wp-block-columns-is-layout-flex">
							<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
								<h2 class="wp-block-heading  secondary-title text-center">Destination</h2>
								<p class="container desc my-2rem">Forem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. </p>
								<p class="container desc my-2rem">Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
								<p class="container desc my-2rem">Class aptent taciti sociosqu ad. Praesent auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus nisl, eu tempor urna.</p>
							</div>
							<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow">
								<figure class="wp-block-image size-full">
									<img decoding="async" width="860" height="754" src="' . home_url('/') . 'wp-content/uploads/2024/09/homepage-4.png" alt="" class="wp-image-357">
								</figure>
							</div>
						</div>
					</section>
				</div>
			</div>

			<button class="slider-arrow left-arrow">
				<img src="' . get_template_directory_uri() . '/images/left-arrow.svg" />
			</button>

			<button class="slider-arrow right-arrow">
				<img src="' . get_template_directory_uri() . '/images/right-arrow.svg" />
			</button>
		</div>
	';
}
