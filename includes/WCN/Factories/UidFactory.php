<?php

namespace WCN\Factories;

use WCN\AbstractFactory;
use WCN\ElementInterface;
use WCN\Elements\DefaultUid;

/**
 * Class UidFactory
 * @package WCN\Factories
 */
class UidFactory extends AbstractFactory {

	/**
	 * @inheritDoc
	 */
	public function get_default(): ElementInterface {
		return new DefaultUid();
	}

	/**
	 * @return string
	 */
	protected function get_element_constant_name(): string {
		return 'WCN_UID_METHOD';
	}

	/**
	 * @return string
	 */
	protected function get_fixed_value_const_constant_name(): string {
		return 'WCN_UID';
	}

	/**
	 * @return string
	 */
	protected function get_cookie_name_constant_name(): string {
		return 'WCN_UID_COOKIE_NAME';
	}

	/**
	 * @return string
	 */
	protected function get_url_param_constant_name(): string {
		return 'WCN_UID_URL_PARAMETER_NAME';
	}
}