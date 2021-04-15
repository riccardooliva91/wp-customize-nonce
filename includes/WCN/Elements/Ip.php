<?php

namespace WCN\Elements;

use WCN\ElementInterface;

/**
 * Class Ip
 * @package WCN\Elements
 *
 * @codeCoverageIgnore
 */
class Ip implements ElementInterface {

	/**
	 * @inheritDoc
	 */
	public function get() {
		return filter_input(INPUT_SERVER, 'HTTP_X_REAL_IP');
	}

}