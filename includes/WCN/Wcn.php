<?php

namespace WCN;

use WCN\Factories\UidFactory;
use WCN\Factories\TokenFactory;

/**
 * Class Wcn
 * @package WCN
 */
class Wcn {

	/**
	 * @var mixed
	 */
	protected $action;

	/**
	 * @var mixed
	 */
	protected $uid;

	/**
	 * @var mixed
	 */
	protected $token;

	/**
	 * @var int
	 */
	protected $tick;


	/**
	 * Wcn constructor.
	 *
	 * @param int $action
	 */
	public function __construct( $action = - 1 ) {
		$this->action = $action;
	}

	/**
	 * @return mixed
	 * @throws Exceptions\InvalidConstantValue
	 * @throws Exceptions\UndefinedOrEmptyConstant
	 */
	public function get_uid() {
		if ( empty( $this->uid ) ) {
			$this->uid = ( new UidFactory() )->get();
			if ( empty( $this->uid ) ) {
				$this->uid = apply_filters( 'nonce_user_logged_out', $this->uid, $this->action );
			}
		}

		return $this->uid->get();
	}

	/**
	 * @return mixed
	 * @throws Exceptions\InvalidConstantValue
	 * @throws Exceptions\UndefinedOrEmptyConstant
	 */
	public function get_token() {
		if ( empty( $this->token ) ) {
			$this->token = ( new TokenFactory() )->get();
		}

		return $this->token->get();
	}

	/**
	 * @return int
	 */
	public function get_tick(): int {
		if ( empty( $this->tick ) ) {
			$this->tick = wp_nonce_tick();
		}

		return $this->tick;
	}

	/**
	 * @param string $nonce
	 *
	 * @return false|int
	 * @throws Exceptions\InvalidConstantValue
	 * @throws Exceptions\UndefinedOrEmptyConstant
	 */
	public function validate( string $nonce ) {
		if ( hash_equals( $this->generate_nonce(), $nonce ) ) {
			return 1;
		}

		$deep = defined( 'WCN_VALIDATE_OLD_NONCES' ) ? WCN_VALIDATE_OLD_NONCES : true;
		if ( $deep ) {
			if ( hash_equals( $this->generate_nonce( $deep ), $nonce ) ) {
				return 2;
			}
		}

		return false;
	}

	/**
	 * @param bool|null $deep
	 *
	 * @return string
	 *
	 * @throws Exceptions\InvalidConstantValue
	 * @throws Exceptions\UndefinedOrEmptyConstant
	 */
	public function generate_nonce( bool $deep = null ): string {
		if ( is_null( $deep ) ) {
			$deep = defined( 'WCN_VALIDATE_OLD_NONCES' ) ? WCN_VALIDATE_OLD_NONCES : true;
		}

		$schema = defined( 'WCN_NONCE_SCHEMA' ) ? WCN_NONCE_SCHEMA : 'nonce';
		$offset = defined( 'WCN_NONCE_OFFSET' ) ? (int) WCN_NONCE_OFFSET : - 12;
		$length = defined( 'WCN_NONCE_LENGTH' ) ? (int) WCN_NONCE_LENGTH : 10;
		$values = array_filter( [
			'tick'   => $deep ? $this->get_tick() - 1 : $this->get_tick(),
			'action' => $this->action,
			'uid'    => $this->get_uid(),
			'token'  => $this->get_token(),
		] );

		return substr( wp_hash( implode( '|', $values ), $schema ), $offset, $length );
	}

}