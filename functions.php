<?php
/**
 * Agapanto functions and definitions
 *
 * @package Agapanto
 */

if ( ! function_exists( 'agapanto_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for ClassicPress features.
	 */
	function agapanto_setup() {
		// Make theme available for translation
		load_theme_textdomain( 'agapanto', get_template_directory() . '/languages' );

		// Let ClassicPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register a single navigation menu location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'agapanto' ),
		) );

		// Enable support for selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Set content width (optional)
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 720;
		}
	}
endif;
add_action( 'after_setup_theme', 'agapanto_setup' );


if ( ! function_exists( 'agapanto_scripts' ) ) :
	/**
	 * Enqueue theme styles and scripts.
	 */
	function agapanto_scripts() {
		// Enqueue main stylesheet
		wp_enqueue_style( 'agapanto-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

		// Enqueue a JavaScript file (optional)
		// wp_enqueue_script( 'agapanto-script', get_template_directory_uri() . '/js/script.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
	}
endif;
add_action( 'wp_enqueue_scripts', 'agapanto_scripts' );


/**
 * Register widget areas (optional)
 *
 * Remove or comment this out if you don't use widgets.
 */
function agapanto_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'agapanto' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here.', 'agapanto' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'agapanto_widgets_init' );
