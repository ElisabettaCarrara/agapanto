<?php
/**
 * Agapanto back compat functionality
 *
 * Prevents Agapanto from running on ClassicPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package Agapanto
 *
 * Original Code: Twenty Seventeen http://wordpress.org/themes/twentyseventeen
 * Original Copyright: the ClassicPress team and contributors.
 *
 * The following code is a derivative work of the code from the Twenty Seventeen theme,
 * which is licensed GPLv2 or later. This code therefore is also licensed under the terms
 * of the GNU Public License, version 2.
 */

/**
 * Prevent switching to Agapanto on old versions of ClassicPress.
 *
 * Switches to the default theme.
 *
 * @since Agapanto 1.0
 */
function agapanto_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'agapanto_upgrade_notice' );
}
add_action( 'after_switch_theme', 'agapanto_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Agapanto on ClassicPress versions prior to 4.7.
 *
 * @global string $wp_version ClassicPress version.
 */
function agapanto_upgrade_notice() {
	$message = sprintf( esc_html__( '%1$s requires at least ClassicPress version %2$s. You are running version %3$s. Please upgrade and try again.', 'agapanto' ), 'Agapanto', '4.7', $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on ClassicPress versions prior to 4.7.
 *
 * @global string $wp_version ClassicPress version.
 */
function agapanto_customize() {
	wp_die(
		sprintf( esc_html__( '%1$s requires at least ClassicPress version %2$s. You are running version %3$s. Please upgrade and try again.', 'agapanto' ), 'Agapanto', '4.7', $GLOBALS['wp_version'] ),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'agapanto_customize' );

/**
 * Prevents the Theme Preview from being loaded on ClassicPress versions prior to 4.7.
 *
 * @global string $wp_version ClassicPress version.
 */
function agapanto_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( '%1$s requires at least ClassicPress version %2$s. You are running version %3$s. Please upgrade and try again.', 'agapanto' ), 'Agapanto', '4.7', $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'agapanto_preview' );
