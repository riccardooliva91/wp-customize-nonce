<?php

namespace WCN;

use WCN\Exceptions\InvalidConstantValue;
use WCN\Exceptions\UndefinedOrEmptyConstant;
use WCN\Elements\{Cookie, EmptyElement, Ip, UrlParameter, UserId};

/**
 * Class AbstractFactory
 * @package WCN
 */
abstract class AbstractFactory {

	/**
	 * Build and get the required element
	 *
	 * @return ElementInterface
	 * @throws InvalidConstantValue|UndefinedOrEmptyConstant
	 */
	public function get() {
		$method_const = $this->get_method_constant_name();
		if ( ! defined( $method_const ) ) {
			throw new UndefinedOrEmptyConstant( $method_const );
		}

		switch ( constant( $method_const ) ) {
			case 'user_id':// Default WP method
				return new UserId();

			case 'ip':
				return new Ip();

			case 'none':
				return new EmptyElement();

			case 'url_param':
				$param_const = $this->get_url_param_constant_name();
				$this->validate( $param_const );

				return new UrlParameter( $param_const );

			case 'cookie':
				$cookie_const = $this->get_cookie_constant_name();
				$this->validate( $cookie_const );

				return new Cookie( constant( $cookie_const ) );

			default:
				throw new InvalidConstantValue( $method_const, constant( $method_const ) );
		}
	}

	/**
	 * Build method constant name
	 *
	 * @return string
	 */
	protected function get_method_constant_name(): string {
		return sprintf( 'WCN_%s_METHOD', $this->get_element() );
	}

	/**
	 * Build cookie constant name
	 *
	 * @return string
	 */
	protected function get_cookie_constant_name(): string {
		return sprintf( 'WCN_%s_COOKIE_NAME', $this->get_element() );
	}

	/**
	 * Build url param constant name
	 *
	 * @return string
	 */
	protected function get_url_param_constant_name(): string {
		return sprintf( 'WCN_%s_URL_PARAMETER_NAME', $this->get_element() );
	}

	/**
	 * To be defined by concrete implementations
	 *
	 * @return string
	 */
	protected abstract function get_element(): string;

	/**
	 * Validate situational constant
	 *
	 * @param string $const
	 *
	 * @return void
	 *
	 * @throws UndefinedOrEmptyConstant
	 */
	protected function validate( string $const ): void {
		if ( ! defined( $const ) ) {
			throw new UndefinedOrEmptyConstant( $const );
		}
	}

}