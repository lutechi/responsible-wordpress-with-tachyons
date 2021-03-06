<?php
/**
 * Smew Theme Theme Customizer
 *
 * @package Wistiti
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function smew_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//Add mini logo to Site identity
	$wp_customize->add_setting( 'smew_siteidentity_minilogo' , array(
		'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control(
           $wp_customize,
           'smew_siteidentity_minilogo',
           array(
               'label'      => __( 'Upload a mini logo', 'wistiti' ),
               'section'    => 'title_tagline',
               'settings'   => 'smew_siteidentity_minilogo'
           )
    ) );

	//Live Preview
	$wp_customize->get_setting( 'smew_siteidentity_minilogo' )->transport = 'postMessage';

	//Add tachyons colors choice
	//Test from https://premium.wpmudev.org/blog/wordpress-theme-customizer-guide/?imob=b&utm_expid=3606929-106.UePdqd0XSL687behGg-9FA.1&utm_referrer=https%3A%2F%2Fwww.google.fr%2F
	$wp_customize->add_section( 'smew_colors' , array(
    'title'      => 'Colors',
    'priority'   => 91,
	) );
	$wp_customize->add_setting( 'smew_colors_brand' , array(
    'default'     => '',
    'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 'smew_colors_brand', array(
	    'label' => 'Brand color',
			'section'	=> 'smew_colors',
			'type'	 => 'text',
	) );

	//Live Preview
	$wp_customize->get_setting( 'smew_colors_brand' )->transport = 'postMessage';


	//Add site layout options
	$wp_customize->add_section( 'smew_layout' , array(
		'title'      => 'Layout',
		'priority'   => 90,
	) );

	$wp_customize->add_setting( 'smew_layout_header' , array(
		'default'     => true,
		'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 'smew_layout_header', array(
			'label' => 'Display header',
			'section'	=> 'smew_layout',
			'type'	 => 'checkbox',
	) );

	$wp_customize->add_setting( 'smew_layout_description' , array(
		'default'     => true,
		'transport'   => 'postMessage',
	) );

	$wp_customize->add_control( 'smew_layout_description', array(
			'label' => 'Display description',
			'section'	=> 'smew_layout',
			'type'	 => 'checkbox',
	) );

	//Live preview
	$wp_customize->get_setting( 'smew_layout_header' )->transport = 'postMessage';
	$wp_customize->get_setting( 'smew_layout_description' )->transport = 'postMessage';

}
add_action( 'customize_register', 'smew_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function smew_theme_customize_preview_js() {
	wp_enqueue_script( 'smew_theme_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'smew_theme_customize_preview_js' );
