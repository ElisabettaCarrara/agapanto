<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package Agapanto
 */

/**
 * Adds all general settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function agapanto_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section(
		'agapanto_section_general',
		array(
			'title'    => esc_html__( 'General Settings', 'agapanto' ),
			'priority' => 10,
			'panel'    => 'agapanto_options_panel',
		)
	);

	// Add Settings and Controls for Layout.
	$wp_customize->add_setting(
		'agapanto_theme_options[layout]',
		array(
			'default'           => 'right-sidebar',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'agapanto_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'agapanto_theme_options[layout]',
		array(
			'label'    => esc_html__( 'Theme Layout', 'agapanto' ),
			'section'  => 'agapanto_section_general',
			'settings' => 'agapanto_theme_options[layout]',
			'type'     => 'radio',
			'priority' => 10,
			'choices'  => array(
				'left-sidebar'  => esc_html__( 'Left Sidebar', 'agapanto' ),
				'right-sidebar' => esc_html__( 'Right Sidebar', 'agapanto' ),
			),
		)
	);

	// Add Sticky Header Setting.
	$wp_customize->add_setting(
		'agapanto_theme_options[sticky_header_title]',
		array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_control(
		new Agapanto_Customize_Header_Control(
			$wp_customize,
			'agapanto_theme_options[sticky_header_title]',
			array(
				'label'    => esc_html__( 'Sticky Header', 'agapanto' ),
				'section'  => 'agapanto_section_general',
				'settings' => 'agapanto_theme_options[sticky_header_title]',
				'priority' => 20,
			)
		)
	);
	$wp_customize->add_setting(
		'agapanto_theme_options[sticky_header]',
		array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'agapanto_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'agapanto_theme_options[sticky_header]',
		array(
			'label'    => esc_html__( 'Enable sticky header feature', 'agapanto' ),
			'section'  => 'agapanto_section_general',
			'settings' => 'agapanto_theme_options[sticky_header]',
			'type'     => 'checkbox',
			'priority' => 30,
		)
	);
}
add_action( 'customize_register', 'agapanto_customize_register_general_settings' );
