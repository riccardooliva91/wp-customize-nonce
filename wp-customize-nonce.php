<?php
/*
Plugin Name: WP customize nonce
Description: A WordPress plugin which allows you to customize the nonce generation and validation.
Version: 1.0
Author: Riccardo Oliva <riccardo91.oliva@gmail.com>
License: MIT
License URI: https://opensource.org/licenses/MIT
*/

if ( ! function_exists( 'wp_create_nonce' ) ) :
	function wp_create_nonce( $action = - 1 ) {
		$uid  = $_SERVER['HTTP_X_REAL_IP'];
		if ( ! $uid ) {
			$uid = apply_filters( 'nonce_user_logged_out', $uid, $action );
		}

		$token = wp_get_session_token();
		$i     = wp_nonce_tick();

		return substr( wp_hash( $i . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), - 12, 10 );
	}
endif;

if ( ! function_exists( 'wp_verify_nonce' ) ) :
	function wp_verify_nonce( $nonce, $action = -1 ) {
		$nonce = (string) $nonce;
		if ( empty( $nonce ) ) {
			return false;
		}

		$token = wp_get_session_token();
		$i     = wp_nonce_tick();

		// Nonce generated 0-12 hours ago.
		$uid = $_SERVER['HTTP_X_REAL_IP'];
		if ( ! $uid ) {
			$uid = apply_filters( 'nonce_user_logged_out', $uid, $action );
		}
		$expected = substr( wp_hash( $i . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), -12, 10 );
		if ( hash_equals( $expected, $nonce ) ) {
			return 1;
		}

		// Nonce generated 12-24 hours ago.
		$expected = substr( wp_hash( ( $i - 1 ) . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), -12, 10 );
		if ( hash_equals( $expected, $nonce ) ) {
			return 2;
		}
		do_action( 'wp_verify_nonce_failed', $nonce, $action, wp_get_current_user(), $token );

		// Invalid nonce.
		return false;
	}
endif;

