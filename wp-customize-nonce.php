<?php
/*
Plugin Name: WP customize nonce
Description: A WordPress plugin which allows you to customize the nonce generation and validation.
Version: 1.0
Author: Riccardo Oliva <riccardo91.oliva@gmail.com>
License: MIT
License URI: https://opensource.org/licenses/MIT
*/

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

if ( ! function_exists( 'wp_verify_nonce' ) ) :

	function wp_verify_nonce( $nonce, $action = - 1 ) {
		if ( empty( $nonce ) ) {
			return false;
		}

		return ( new \WCN\Wcn( $action ) )->validate( $nonce );
	}

endif;

if ( ! function_exists( 'wp_create_nonce' ) ) :

	function wp_create_nonce( $action = - 1 ) {
		return ( new \WCN\Wcn( $action ) )->generate_nonce();
	}

endif;