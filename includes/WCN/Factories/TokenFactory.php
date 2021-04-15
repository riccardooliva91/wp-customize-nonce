<?php

namespace WCN\Factories;

use WCN\AbstractFactory;
use WCN\ElementInterface;
use WCN\Elements\DefaultSessionToken;

/**
 * Class TokenFactory
 * @package WCN\Factories
 *
 * @codeCoverageIgnore
 */
class TokenFactory extends AbstractFactory {

	/**
	 * @inheritDoc
	 */
	public function get_default(): ElementInterface {
		return new DefaultSessionToken();
	}

	/**
	 * @return string
	 */
	protected function get_element_constant_name(): string {
		return 'WCN_TOKEN_METHOD';
	}

	/**
	 * @return string
	 */
	protected function get_fixed_value_const_constant_name(): string {
		return 'WCN_TOKEN';
	}

	/**
	 * @return string
	 */
	protected function get_cookie_name_constant_name(): string {
		return 'WCN_TOKEN_COOKIE_NAME';
	}

	/**
	 * @return string
	 */
	protected function get_url_param_constant_name(): string {
		return 'WCN_TOKEN_URL_PARAMETER_NAME';
	}

}