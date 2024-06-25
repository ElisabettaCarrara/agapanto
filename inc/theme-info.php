<?php
/**
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the ClassicPress Dashboard.
 *
 * @package Agapanto
 */

/**
 * Add Theme Info page to admin menu
 */
function agapanto_theme_info_menu_link() {

	// Get theme details.
	$theme = wp_get_theme();

	add_theme_page(
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'agapanto' ), $theme->display( 'Name' ), $theme->display( 'Version' ) ),
		esc_html__( 'Theme Info', 'agapanto' ),
		'edit_theme_options',
		'agapanto',
		'agapanto_theme_info_page'
	);

}
add_action( 'admin_menu', 'agapanto_theme_info_menu_link' );

/**
 * Display Theme Info page
 */
function agapanto_theme_info_page() {

	// Get theme details.
	$theme = wp_get_theme();
	?>

	<div class="wrap theme-info-wrap">

		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'agapanto' ), esc_html( $theme->display( 'Name' ) ), esc_html( $theme->display( 'Version' ) ) ); ?></h1>

		<div class="theme-description"><?php echo esc_html( $theme->display( 'Description' ) ); ?></div>

		<hr>

		<div id="getting-started">

			<h3><?php printf( esc_html__( 'Getting Started with %s', 'agapanto' ), esc_html( $theme->display( 'Name' ) ) ); ?></h3>

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Theme Documentation', 'agapanto' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'You need help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'agapanto' ); ?>
						</p>
					</div>

					<div class="section">
						<h4><?php esc_html_e( 'Theme Options', 'agapanto' ); ?></h4>

						<p class="about">
							<?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'agapanto' ), esc_html( $theme->display( 'Name' ) ) ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url_raw( wp_customize_url() ); ?>" class="button button-primary"><?php esc_html_e( 'Customize Theme', 'agapanto' ); ?></a>
						</p>
					</div>

				</div>

				<div class="column column-half clearfix">

					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.jpg" />

				</div>

			</div>

		</div>

		<hr>

	</div>

	<?php
}

/**
 * Enqueues CSS for Theme Info page
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function agapanto_theme_info_page_css( $hook ) {

	// Load styles and scripts only on theme info page.
	if ( 'appearance_page_agapanto' != $hook ) {
		return;
	}

	// Embed theme info css style.
	wp_enqueue_style( 'agapanto-theme-info-css', get_template_directory_uri() . '/assets/css/theme-info.css' );

}
add_action( 'admin_enqueue_scripts', 'agapanto_theme_info_page_css' );
