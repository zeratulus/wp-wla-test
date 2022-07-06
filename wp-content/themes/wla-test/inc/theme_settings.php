<?php

add_action( 'customize_register', 'customizations' );
function customizations( $wp_customize ) {
	$wp_customize->add_section( 'main_settings', array(
		'title'    => __( 'Main Page Settings' ),
		'priority' => 0,
	) );

	$wp_customize->add_setting( 'theme_logo', array(
		'default' => get_theme_file_uri('images/logo.png'),
		'sanitize_callback' => 'esc_url_raw'
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_control', array(
		'label' => 'Upload Logo',
		'priority' => 0,
		'section' => 'main_settings',
		'settings' => 'theme_logo',
		'button_labels' => [
			'select' => 'Select Logo',
			'remove' => 'Remove Logo',
			'change' => 'Change Logo',
		]
	)));

	$wp_customize->add_setting( 'google_maps_api_key' );
	$wp_customize->add_control( 'google_maps_api_key', array(
		'id'      => 'google_maps_api_key',
		'label'   => __( 'Google Maps API Key:' ),
		'section' => 'main_settings'
	) );

	$wp_customize->add_setting( 'top_gallery', [
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'validate_select',
		'default'           => null,
		'transport'         => 'postMessage',
	] );

	$options = [];

	$galleries = new WP_Query( [
		'post_type' => 'gallery',
		'nopaging'  => true
	] );

	foreach ( $galleries->posts as $gallery ) {
		$options[ $gallery->ID ] = $gallery->post_title;
	}

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_gallery',
		[
			'type'        => 'select',
			'section'     => 'main_settings',
			'label'       => __( 'Top Gallery for slickslider.js' ),
			'description' => __( 'Select gallery for top slider.' ),
			'choices'     => $options
		]
	) );

	$wp_customize->add_setting( 'footer_text' );
	$wp_customize->add_control( 'footer_text', array(
		'id'      => 'footer_text',
		'label'   => __( 'Footer Text:' ),
		'section' => 'main_settings'
	) );

	function validate_select( $input, $setting ) {
		$input = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

}
