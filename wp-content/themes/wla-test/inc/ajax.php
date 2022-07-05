<?php

function jsonResponse( $json ) {
	header( 'Content-type: application/json' );
	die( json_encode( $json ) );
}

function get_testimonials_alphabet() {
	global $wpdb;
	$json = [];

	$results = $wpdb->get_results( "SELECT DISTINCT UPPER(SUBSTRING(post_title, 1, 1)) as alpha FROM {$wpdb->posts} WHERE post_type = 'testimonial' AND post_status = 'publish' ORDER BY alpha ASC" );

	$json['success'] = true;
	$json['items']   = $results;

	jsonResponse( $json );
}

function get_testimonials() {
	global $wpdb;
	$json = [];

	$alpha = isset( $_GET['alpha'] ) ? substr( $_GET['alpha'], 0, 1 ) : '';
	if ( ! empty( $alpha ) ) {
		$dir = wp_upload_dir()['baseurl'];

		$sql = "SELECT p.*, CONCAT( '{$dir}', '/', thumb.meta_value) as image FROM {$wpdb->posts} p
			LEFT JOIN {$wpdb->postmeta} thumbnail_id
	            ON thumbnail_id.post_id = p.ID AND thumbnail_id.meta_key = '_thumbnail_id'
	        
	        LEFT JOIN {$wpdb->postmeta} thumb
	            ON thumb.post_id = thumbnail_id.meta_value AND thumb.meta_key = '_wp_attached_file'

			WHERE p.post_type = 'testimonial' 
				AND p.post_status = 'publish' 
			  	AND p.post_title LIKE '{$alpha}%' 
			ORDER BY post_title ASC";

		$results = $wpdb->get_results( $sql );

		$json['success'] = true;
		$json['items']   = $results;
	} else {
		$json['success'] = false;
		$json['error']   = 'Error: alpha is required GET param';
	}

	jsonResponse( $json );
}

function get_locations() {
	$json = [];

	$args = [
		'post_type' => 'map_location',
		'nopaging'  => true,
	];

	$locations = new WP_Query( $args );

	$json['success'] = true;
	$json['items']   = $locations->posts;

	jsonResponse( $json );
}

function get_location() {
	$json = [];

	$id = isset( $_GET['map_location_id'] ) ? $_GET['map_location_id'] : '';
	if ( ! empty( $id ) ) {
		$args = [
			'post_type'         => 'map_location',
			'queried_object_id' => $id
		];

		$location = new WP_Query( $args );

		$item = $location->post;
		$item->gallery = get_field('gallery', $item->ID);

		$json['success'] = true;
		$json['item']    = $item;
	} else {
		$json['success'] = false;
		$json['error']   = 'Error: map_location_id is required GET param';
	}

	jsonResponse( $json );
}


add_action( 'wp_ajax_get_testimonials_alphabet', 'get_testimonials_alphabet' );
add_action( 'wp_ajax_nopriv_get_testimonials_alphabet', 'get_testimonials_alphabet' );
add_action( 'wp_ajax_get_testimonials', 'get_testimonials' );
add_action( 'wp_ajax_nopriv_get_testimonials', 'get_testimonials' );
add_action( 'wp_ajax_get_locations', 'get_locations' );
add_action( 'wp_ajax_nopriv_get_locations', 'get_locations' );
add_action( 'wp_ajax_get_location', 'get_location' );
add_action( 'wp_ajax_nopriv_get_location', 'get_location' );
