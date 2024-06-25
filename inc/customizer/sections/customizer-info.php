<?php
/**
 * Theme Info Settings
 *
 * Register Theme Info Settings
 *
 * @package Agapanto
 */

/**
 * Adds all Theme Info settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function agapanto_customize_register_theme_info_settings( $wp_customize ) {

	// Add Section for Theme Fonts.
	$wp_customize->add_section(
		'agapanto_section_theme_info',
		array(
			'title'    => esc_html__( 'Theme Info', 'agapanto' ),
			'priority' => 200,
			'panel'    => 'agapanto_options_panel',
		)
	);

	// Add Theme Links control.
	$wp_customize->add_control(
		new Agapanto_Customize_Links_Control(
			$wp_customize,
			'agapanto_theme_options[theme_links]',
			array(
				'section'  => 'agapanto_section_theme_info',
				'settings' => array(),
				'priority' => 10,
			)
		)
	);

	// Add Magazine Blocks control.
	if ( ! class_exists( 'ThemeZee_Magazine_Blocks' ) ) {
		$wp_customize->add_control(
			new Agapanto_Customize_Plugin_Control(
				$wp_customize,
				'agapanto_theme_options[magazine_blocks]',
				array(
					'label'       => esc_html__( 'Magazine Blocks', 'agapanto' ),
					'description' => esc_html__( 'Install our free Magazine Blocks to create a magazine-styled homepage in the Editor with just a few clicks.', 'agapanto' ),
					'section'     => 'agapanto_section_theme_info',
					'settings'    => array(),
					'priority'    => 40,
				)
			)
		);
	}
}
add_action( 'customize_register', 'agapanto_customize_register_theme_info_settings' );
