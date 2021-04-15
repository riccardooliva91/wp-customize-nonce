<?php

namespace WCN;

use WCN\Exceptions\InvalidConstantValue;
use WCN\Exceptions\UndefinedOrEmptyConstant;
use WCN\Elements\{Cookie, EmptyElement, Ip, UrlParameter, Value};

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
	public function get(): ElementInterface {
		$element = $this->get_element_constant_name();
		if ( ! defined( $element ) ) {
			throw new UndefinedOrEmptyConstant( $element );
		}

		switch ( constant( $element ) ) {
			case 'default': // Default WP method
				return $this->get_default();

			case 'ip':
				return new Ip();

			case 'none':
				return new EmptyElement();

			case 'url_param':
				$param = $this->get_url_param_constant_name();
				$this->validate( $param );

				return new UrlParameter( constant( $param ) );

			case 'cookie':
				$cookie = $this->get_cookie_name_constant_name();
				$this->validate( $cookie );

				return new Cookie( constant( $cookie ) );

			case 'fixed':
				$value = $this->get_fixed_value_const_constant_name();
				$this->validate( $value );

				return new Value( constant( $value ) );

			default:
				throw new InvalidConstantValue( $element, constant( $element ) );
		}
	}

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

	/**
	 * Default value for this factory
	 *
	 * @return ElementInterface
	 */
	protected abstract function get_default(): ElementInterface;

	/**
	 * @return string
	 */
	protected abstract function get_element_constant_name(): string;

	/**
	 * @return string
	 */
	protected abstract function get_fixed_value_const_constant_name(): string;

	/**
	 * @return string
	 */
	protected abstract function get_cookie_name_constant_name(): string;

	/**
	 * @return string
	 */
	protected abstract function get_url_param_constant_name(): string;

}