<?php

add_theme_support( 'title-tag' );
add_theme_support( 'menus' );

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts_and_styles');
function theme_enqueue_scripts_and_styles() {
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('slick', get_template_directory_uri() .  '/assets/slick/slick.css');
	wp_enqueue_style('slick-theme', get_template_directory_uri() .  '/assets/slick/slick-theme.css');
	wp_enqueue_script('slick', get_template_directory_uri() . '/assets/slick/slick.js');
	wp_enqueue_style('fontawesome', get_template_directory_uri() .  '/assets/fontawesome/css/all.min.css');
	wp_enqueue_script('common-js', get_template_directory_uri() . '/assets/js/common.js');
	wp_enqueue_script('ajax-handlers', get_template_directory_uri() . '/assets/js/ajax.js');
}

add_action('after_setup_theme', 'register_menu');
function register_menu() {
	register_nav_menu('header', 'Top header menu');
}

//Google Maps API Key
add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	acf_update_setting('google_api_key', get_theme_mod('google_maps_api_key'));
}