<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package Agapanto
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class Agapanto_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'agapanto' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://elica.com/themes/agapanto/', 'agapanto' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=agapanto&utm_content=theme-page" target="_blank">
						<?php esc_html_e( 'Theme Page', 'agapanto' ); ?>
					</a>
				</p>

				<p>
					<a href="http://preview.elica.com/?demo=agapanto&utm_source=customizer&utm_campaign=agapanto" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'agapanto' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://elica.com/docs/agapanto-documentation/', 'agapanto' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=agapanto&utm_content=documentation" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'agapanto' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://elica.com/changelogs/?action=elica-changelog&type=theme&slug=agapanto/', 'agapanto' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Changelog', 'agapanto' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/agapanto/reviews/', 'agapanto' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'agapanto' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
