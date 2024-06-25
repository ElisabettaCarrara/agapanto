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
		<div class="important-links clearfix">
			<p><strong><?php esc_html_e( 'Theme Links', 'agapanto' ); ?>:</strong>
				<a href="<?php echo esc_url( __( 'https://elica.com/themes/agapanto/', 'agapanto' ) . '?utm_source=theme-info&utm_medium=textlink&utm_campaign=agapanto&utm_content=theme-page' ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'agapanto' ); ?></a>
				<a href="http://preview.elica.com/?demo=agapanto&utm_source=theme-info&utm_campaign=agapanto" target="_blank"><?php esc_html_e( 'Theme Demo', 'agapanto' ); ?></a>
				<a href="<?php echo esc_url( __( 'https://elica.com/docs/agapanto-documentation/', 'agapanto' ) . '?utm_source=theme-info&utm_medium=textlink&utm_campaign=agapanto&utm_content=documentation' ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'agapanto' ); ?></a>
				<a href="<?php echo esc_url( __( 'https://elica.com/changelogs/?action=elica-changelog&type=theme&slug=agapanto', 'agapanto' ) ); ?>" target="_blank"><?php esc_html_e( 'Theme Changelog', 'agapanto' ); ?></a>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/agapanto/reviews/', 'agapanto' ) ); ?>" target="_blank"><?php esc_html_e( 'Rate this theme', 'agapanto' ); ?></a>
			</p>
		</div>
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
						<p>
							<a href="<?php echo esc_url( __( 'https://elica.com/docs/agapanto-documentation/', 'agapanto' ) . '?utm_source=theme-info&utm_medium=button&utm_campaign=agapanto&utm_content=documentation' ); ?>" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'View %s Documentation', 'agapanto' ), 'Agapanto' ); ?>
							</a>
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

		<div id="more-features">

			<h3><?php esc_html_e( 'Get more features', 'agapanto' ); ?></h3>

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Pro Version Add-on', 'agapanto' ); ?></h4>

						<p class="about">
							<?php printf( esc_html__( 'Purchase the %s Pro Add-on and get additional features and advanced customization options.', 'agapanto' ), 'Agapanto' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( __( 'https://elica.com/addons/agapanto-pro/', 'agapanto' ) . '?utm_source=theme-info&utm_medium=button&utm_campaign=agapanto&utm_content=pro-version' ); ?>" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'Learn more about %s Pro', 'agapanto' ), 'Agapanto' ); ?>
							</a>
						</p>
					</div>

				</div>

				<div class="column column-half clearfix">

					<div class="section">
						<h4><?php esc_html_e( 'Recommended Plugins', 'agapanto' ); ?></h4>

						<p class="about">
							<?php esc_html_e( 'Extend the functionality of your ClassicPress website with our free and easy to use plugins.', 'agapanto' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( admin_url( 'plugin-install.php?tab=search&type=tag&s=elica' ) ); ?>" class="button button-secondary">
								<?php esc_html_e( 'Install Plugins', 'agapanto' ); ?>
							</a>
						</p>
					</div>

				</div>

			</div>

		</div>

		<hr>

		<div id="theme-author">

			<p>
				<?php
				printf(
					esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'agapanto' ),
					esc_html( $theme->display( 'Name' ) ),
					'<a target="_blank" href="' . esc_url_raw( __( 'https://elica.com/', 'agapanto' ) . '?utm_source=theme-info&utm_medium=footer&utm_campaign=agapanto' ) . '" title="ThemeZee">ThemeZee</a>',
					'<a target="_blank" href="' . esc_url_raw( __( 'https://wordpress.org/support/theme/agapanto/reviews/', 'agapanto' ) ) . '" title="' . esc_attr__( 'Review Agapanto', 'agapanto' ) . '">' . esc_html__( 'rate it', 'agapanto' ) . '</a>'
				);
				?>
			</p>

		</div>

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
