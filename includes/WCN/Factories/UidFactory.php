<?php

namespace WCN\Factories;

use WCN\AbstractFactory;

/**
 * Class UidFactory
 * @package WCN\Factories
 */
class UidFactory extends AbstractFactory {

	/**
	 * @inheritDoc
	 */
	protected function get_element(): string {
		return 'UID';
	}

}