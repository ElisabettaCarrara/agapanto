<?php
/**
 * Custom functions that are not template related
 *
 * @package Agapanto
 */

if ( ! function_exists( 'agapanto_default_menu' ) ) :
	/**
	 * Display default page as navigation if no custom menu was set
	 */
	function agapanto_default_menu() {

		$attr = array(
				'li' => array(
					'class' => array()
				),
				'a'  => array(
					'href' => array()
				),
		);
		echo '<ul id="menu-main-navigation" class="main-navigation-menu menu">' . wp_kses( $list_pages, $attr ) . '</ul>';

	}
endif;


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function agapanto_body_classes( $classes ) {

	// Get theme options from database.
	$theme_options = agapanto_theme_options();

	// Check if sidebar widget area is empty or switch sidebar layout to left.
	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	} elseif ( 'left-sidebar' == $theme_options['layout'] ) {
		$classes[] = 'sidebar-left';
	}

	// Add small post layout class.
	if ( ( is_archive() or is_home() or is_search() ) and 'left' == $theme_options['post_layout_archives'] ) {
		$classes[] = 'post-layout-small';
	}

	// Hide Date?
	if ( false === $theme_options['meta_date'] ) {
		$classes[] = 'date-hidden';
	}

	// Hide Author?
	if ( false === $theme_options['meta_author'] ) {
		$classes[] = 'author-hidden';
	}

	// Hide Categories?
	if ( false === $theme_options['meta_category'] ) {
		$classes[] = 'categories-hidden';
	}

	// Check for AMP pages.
	if ( agapanto_is_amp() ) {
		$classes[] = 'is-amp-page';
	}

	return $classes;
}
add_filter( 'body_class', 'agapanto_body_classes' );


/**
 * Hide Elements with CSS.
 *
 * @return void
 */
function agapanto_hide_elements() {

	// Get theme options from database.
	$theme_options = agapanto_theme_options();

	$elements = array();

	// Hide Site Title?
	if ( false === $theme_options['site_title'] ) {
		$elements[] = '.site-title';
	}

	// Hide Site Description?
	if ( false === $theme_options['site_description'] ) {
		$elements[] = '.site-description';
	}

	// Hide Post Tags?
	if ( false === $theme_options['meta_tags'] ) {
		$elements[] = '.type-post .entry-footer .entry-tags';
	}

	// Hide Post Navigation?
	if ( false === $theme_options['post_navigation'] ) {
		$elements[] = '.type-post .entry-footer .post-navigation';
	}

	// Allow plugins to add own elements.
	$elements = apply_filters( 'agapanto_hide_elements', $elements );

	// Return early if no elements are hidden.
	if ( empty( $elements ) ) {
		return;
	}

	// Create CSS.
	$classes    = implode( ', ', $elements );
	$custom_css = $classes . ' { position: absolute; clip: rect(1px, 1px, 1px, 1px); width: 1px; height: 1px; overflow: hidden; }';

	// Add Custom CSS.
	wp_add_inline_style( 'agapanto-stylesheet', $custom_css );
}
add_filter( 'wp_enqueue_scripts', 'agapanto_hide_elements', 11 );


/**
 * Add custom CSS to scale down logo image for retina displays.
 *
 * @return void
 */
function agapanto_retina_logo() {
	// Return early if there is no logo image or option for retina logo is disabled.
	if ( ! has_custom_logo() or false === agapanto_get_option( 'retina_logo' ) ) {
		return;
	}

	// Get Logo Image.
	$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

	// Create CSS.
	$css = '.site-branding .custom-logo { width: ' . absint( floor( $logo[1] / 2 ) ) . 'px; }';

	// Add Custom CSS.
	wp_add_inline_style( 'agapanto-stylesheet', $css );
}
add_filter( 'wp_enqueue_scripts', 'agapanto_retina_logo', 11 );


/**
 * Change excerpt length for default posts
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function agapanto_excerpt_length( $length ) {

	// Get theme options from database.
	$theme_options = agapanto_theme_options();

	// Return excerpt text.
	if ( isset( $theme_options['excerpt_length'] ) and $theme_options['excerpt_length'] >= 0 ) :
		return absint( $theme_options['excerpt_length'] );
	else :
		return 30; // Number of words.
	endif;
}
add_filter( 'excerpt_length', 'agapanto_excerpt_length' );


/**
 * Change excerpt more text for posts
 *
 * @param String $more_text Excerpt More Text.
 * @return string
 */
function agapanto_excerpt_more( $more_text ) {

	// Get theme options from database.
	$theme_options = agapanto_theme_options();

	return esc_attr( $theme_options['excerpt_more'] );

}
add_filter( 'excerpt_more', 'agapanto_excerpt_more' );


/**
 * Set wrapper start for wooCommerce
 */
function agapanto_wrapper_start() {
	echo '<section id="primary" class="content-area">';
	echo '<main id="main" class="site-main" role="main">';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'agapanto_wrapper_start', 10 );


/**
 * Set wrapper end for wooCommerce
 */
function agapanto_wrapper_end() {
	echo '</main><!-- #main -->';
	echo '</section><!-- #primary -->';
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content', 'agapanto_wrapper_end', 10 );
