<?php

/**
 * Agapanto functions and definitions
 *
 * @package Agapanto
 */

if (!function_exists('agapanto_setup')) :
	/**
	 * Sets up theme defaults and registers support for various ClassicPress/ClassicPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function agapanto_setup()
	{

		// Make theme available for translation. Translations can be filed in the /languages/ directory.
		load_theme_textdomain('agapanto', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Let ClassicPress manage the document title.
		add_theme_support('title-tag');

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');

		// Set detfault Post Thumbnail size.
		set_post_thumbnail_size(840, 560, true);

		// Register Navigation Menu.
		register_nav_menu('primary', esc_html__('Main Navigation', 'agapanto'));

		// Set up the ClassicPress core custom background feature.
		add_theme_support('custom-background', apply_filters('agapanto_custom_background_args', array('default-color' => 'ffffff')));

		// Set up the ClassicPress core custom logo feature.
		add_theme_support(
			'custom-logo',
			apply_filters(
				'agapanto_custom_logo_args',
				array(
					'height'      => 50,
					'width'       => 250,
					'flex-height' => true,
					'flex-width'  => true,
				)
			)
		);

		// Set up the ClassicPress core custom header feature.
		add_theme_support(
			'custom-header',
			apply_filters(
				'agapanto_custom_header_args',
				array(
					'header-text' => false,
					'width'       => 2500,
					'height'      => 625,
					'flex-height' => true,
				)
			)
		);

		// Add Theme Support for wooCommerce.
		add_theme_support('woocommerce');

		// Add extra theme styling to the visual editor.
		add_editor_style(array('assets/css/editor-style.css'));

		// Add Theme Support for Selective Refresh in Customizer.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for responsive embed blocks.
		add_theme_support('responsive-embeds');
	}
endif;
add_action('after_setup_theme', 'agapanto_setup');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function agapanto_content_width()
{
	$GLOBALS['content_width'] = apply_filters('agapanto_content_width', 840);
}
add_action('after_setup_theme', 'agapanto_content_width', 0);


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function agapanto_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Footer Widget Area 1', 'agapanto'),
		'id'            => 'footer-widget-1',
		'description'   => esc_html__('Footer Widget Area 1', 'agapanto'),
		'before_widget' => '<aside id="%2$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h3 class="footer-widget-title">',
		'after_title'   => '</h3></div>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget Area 2', 'agapanto'),
		'id'            => 'footer-widget-2',
		'description'   => esc_html__('Footer Widget Area 2', 'agapanto'),
		'before_widget' => '<aside id="%2$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h3 class="footer-widget-title">',
		'after_title'   => '</h3></div>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget Area 3', 'agapanto'),
		'id'            => 'footer-widget-3',
		'description'   => esc_html__('Footer Widget Area 3', 'agapanto'),
		'before_widget' => '<aside id="%2$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-header"><h3 class="footer-widget-title">',
		'after_title'   => '</h3></div>',
	));

	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'agapanto'),
			'id'            => 'sidebar',
			'description'   => esc_html__('Appears on posts and pages except the full width template.', 'agapanto'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-header"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		)
	);
}
add_action('widgets_init', 'agapanto_widgets_init');

/**
 * Conditionally register widget areas based on the selected template.
 */
function agapanto_conditional_sidebars() {
    if (is_page_template('template-magazine.php')) {
        register_sidebar(array(
            'name'          => esc_html__('Magazine Homepage', 'agapanto'),
            'id'            => 'magazine-homepage',
            'description'   => esc_html__('Appears on blog index and Magazine Homepage template. You can use the Magazine widgets here.', 'agapanto'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="widget-header"><h3 class="widget-title">',
            'after_title'   => '</h3></div>',
        ));
    }

    if (is_page_template('template-portfolio.php')) {
        register_sidebar(array(
            'name'          => esc_html__('Portfolio Homepage', 'agapanto'),
            'id'            => 'portfolio-homepage',
            'description'   => esc_html__('Appears on blog index and Portfolio Homepage template. You can use the Portfolio widgets here.', 'agapanto'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="widget-header"><h3 class="widget-title">',
            'after_title'   => '</h3></div>',
        ));
    }
}
add_action('wp', 'agapanto_conditional_sidebars');

/* sanitize SVGs */
/* sanitize SVGs */
function agapanto_sanitize_svg($svg) {
    if (!$svg) {
        return '';
    }

    // Allow only specific elements and attributes
    $allowed_tags = array(
        'svg'   => array(
            'class'           => true,
            'aria-hidden'     => true,
            'aria-labelledby' => true,
            'role'            => true,
            'xmlns'           => true,
            'width'           => true,
            'height'          => true,
            'viewbox'         => true,
        ),
        'g'     => array('fill' => true),
        'title' => array('title' => true),
        'path'  => array(
            'd'    => true,
            'fill' => true,
        ),
        'use'   => array(
            'xlink:href' => true,
        ),
    );
    
    // Sanitize
    $sanitized_svg = wp_kses($svg, $allowed_tags);

    return $sanitized_svg;
}

function agapanto_svg_icon($icon) {
    $svg = agapanto_get_svg($icon);
    $sanitized_svg = agapanto_sanitize_svg($svg);
    
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo $sanitized_svg;
}

// Add this new function
function agapanto_escape_svg($svg) {
    return wp_kses_post($svg);
}


/**
 * Enqueue scripts and styles.
 */
function agapanto_scripts()
{

	// Get theme options from database.
	$theme_options = agapanto_theme_options();

	// Get Theme Version.
	$theme_version = wp_get_theme()->get('Version');

	// Register and Enqueue Stylesheet.
	wp_enqueue_style('agapanto-stylesheet', get_stylesheet_uri(), array(), $theme_version);

	// Register and Enqueue HTML5shiv to support HTML5 elements in older IE versions.
	wp_enqueue_script('html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.min.js', array(), '3.7.3');
	wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');

	// Register and enqueue navigation.min.js.
	if ((has_nav_menu('primary') || has_nav_menu('secondary')) && !agapanto_is_amp()) {
		wp_enqueue_script('agapanto-navigation', get_theme_file_uri('/assets/js/navigation.min.js'), array(), '20220224', true);
		$agapanto_l10n = array(
			'expand'   => esc_html__('Expand child menu', 'agapanto'),
			'collapse' => esc_html__('Collapse child menu', 'agapanto'),
			'icon'     => agapanto_get_svg('expand'),
		);
		wp_localize_script('agapanto-navigation', 'agapantoScreenReaderText', $agapanto_l10n);
	}

	// Register and enqueue sticky-header.js.
	if (true == $theme_options['sticky_header'] && !agapanto_is_amp()) {
		wp_enqueue_script('agapanto-jquery-sticky-header', get_template_directory_uri() . '/assets/js/sticky-header.js', array('jquery'), '20170203');
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	if (!agapanto_is_amp()) {
		wp_enqueue_script('svgxuse', get_theme_file_uri('/assets/js/svgxuse.min.js'), array(), '1.2.6');
	}

	// Register Comment Reply Script for Threaded Comments.
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'agapanto_scripts');


/**
 * Enqueue theme fonts.
 */
function agapanto_theme_fonts()
{
	$fonts_url = agapanto_get_fonts_url();

	// Load Fonts if necessary.
	if ($fonts_url) {
		require_once get_theme_file_path('inc/wptt-webfont-loader.php');
		wp_enqueue_style('agapanto-theme-fonts', wptt_get_webfont_url($fonts_url), array(), '20201110');
	}
}
add_action('wp_enqueue_scripts', 'agapanto_theme_fonts', 1);
add_action('enqueue_block_editor_assets', 'agapanto_theme_fonts', 1);


/**
 * Retrieve webfont URL to load fonts locally.
 */
function agapanto_get_fonts_url()
{
	$font_families = array(
		'Ubuntu:400,400italic,700,700italic',
		'Raleway:400,400italic,700,700italic',
	);

	$query_args = array(
		'family'  => rawurlencode(implode('|', $font_families)),
		'subset'  => rawurlencode('latin,latin-ext'),
		'display' => rawurlencode('swap'),
	);

	return apply_filters('agapanto_get_fonts_url', add_query_arg($query_args, 'https://fonts.googleapis.com/css'));
}


/**
 * Add custom sizes for featured images
 */
function agapanto_add_image_sizes()
{

	// Add Custom Header Image Size.
	add_image_size('agapanto-header-image', 1920, 480, true);

	// Add different thumbnail sizes for widgets and post layouts.
	add_image_size('agapanto-thumbnail-small', 120, 80, true);
	add_image_size('agapanto-thumbnail-medium', 360, 240, true);
	add_image_size('agapanto-thumbnail-large', 600, 400, true);
	add_image_size('agapanto-thumbnail-single', 840, 420, true);
}
add_action('after_setup_theme', 'agapanto_add_image_sizes');


/**
 * Make custom image sizes available in Gutenberg.
 */
function agapanto_add_image_size_names($sizes)
{
	return array_merge(
		$sizes,
		array(
			'post-thumbnail'            => esc_html__('Agapanto Blog Post', 'agapanto'),
			'agapanto-thumbnail-single' => esc_html__('Agapanto Single Post', 'agapanto'),
			'agapanto-thumbnail-large'  => esc_html__('Agapanto Magazine Post', 'agapanto'),
			'agapanto-thumbnail-small'  => esc_html__('Agapanto Thumbnail', 'agapanto'),
		)
	);
}
add_filter('image_size_names_choose', 'agapanto_add_image_size_names');


/**
 * Include Files
 */

// Include Theme Info page.
require get_template_directory() . '/inc/theme-info.php';

// Include Theme Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Extra Functions.
require get_template_directory() . '/inc/extras.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-tags.php';

// Include Gutenberg Features.
require get_template_directory() . '/inc/gutenberg.php';

// Include support functions for Theme Addons.
require get_template_directory() . '/inc/addons.php';

// Include Post Slider Setup.
require get_template_directory() . '/inc/slider.php';

// Include Magazine Functions.
require get_template_directory() . '/inc/magazine.php';

// Include Portfolio Functions.
require get_template_directory() . '/inc/portfolio.php';

// Include Widget Files.
require get_template_directory() . '/inc/widgets/widget-magazine-posts-columns.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-grid.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-horizontal-box.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-vertical-box.php';

// Include Widget Files.
require get_template_directory() . '/inc/widgets/widget-portfolio-posts-columns.php';
require get_template_directory() . '/inc/widgets/widget-portfolio-posts-grid.php';
require get_template_directory() . '/inc/widgets/widget-portfolio-posts-horizontal-box.php';
require get_template_directory() . '/inc/widgets/widget-portfolio-posts-vertical-box.php';
